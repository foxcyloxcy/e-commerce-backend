<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Models\Item;
use App\Models\ItemProperty;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Item\ItemResource;
use Illuminate\Support\Facades\Storage;
use App\Models\ItemImage;
use App\Models\ItemComment;
use Illuminate\Http\UploadedFile;



class ItemController extends Controller
{

    /**
     * Get list of items
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {
        // for page size in pagination
        $size = $request->size ?: 10;

        try {
            $data = Item::with('user')->where('status', Item::STATUS_PUBLISHED)
            // ->when(auth('auth-api')->check(), function ($q) use ($request) {
            //     $q->where('user_id', "!=", auth('auth-api')->user()->id);
            // })
            ->when(isset($request->sub_category_id), function ($q) use ($request) {
                $q->where('sub_category_id', $request->sub_category_id);
            })
            ->when(isset($request->filter['properties']), function ($q) use ($request) {
                $subPropertyValueIds = explode(',', $request->filter['properties']);
                
                // Use whereHas to filter items based on item_property relationships
                $q->whereHas('itemProperty', function ($q1) use ($subPropertyValueIds) {
                    $q1->whereIn('sub_property_value_id', $subPropertyValueIds)
                        // Ensure only the items with exactly these properties are returned
                        ->select('item_id')
                        ->groupBy('item_id')
                        ->havingRaw('COUNT(DISTINCT sub_property_value_id) = ?', [count($subPropertyValueIds)]);
                });
            })
            ->when(isset($request->filter['keyword']), function ($q) use ($request) {
                $q->where('item_name','LIKE','%'.$request->filter['keyword'].'%');
            })
            ->when(isset($request->filter['min_price']) || isset($request->filter['max_price']), function ($q) use ($request) {
                $minPrice = isset($request->filter['min_price']) ? (float) $request->filter['min_price'] : null;
                $maxPrice = isset($request->filter['max_price']) ? (float) $request->filter['max_price'] : null;
            
                if ($minPrice !== null && $maxPrice === null) {
                    $q->where('price', '>=', $minPrice);
                } elseif ($minPrice === null && $maxPrice !== null) {
                    $q->where('price', '<=', $maxPrice);
                } elseif ($minPrice !== null && $maxPrice !== null) {
                    $q->whereBetween('price', [$minPrice, $maxPrice]);
                }
            })
            ->when(isset($request->sort), function ($q) use ($request) {
                if ($request->sort == 1) {
                    $q->orderBy('created_at', 'desc');
                } elseif ($request->sort == 2) {
                    $q->orderBy('created_at', 'asc');
                }
            })
            ->paginate($size);

            

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * create new record
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreItemRequest $request) {

        $param = $request->validated();

        DB::beginTransaction();

        try {
            $user = auth('auth-api')->user();
            $param['user_id'] = auth('auth-api')->user()->id;

            // check if user has valid bank details
            if(empty($user->vendorBank)){
                return response(['message' => 'To receive payment for your items please provide bank details by visiting your profile. Once updated you can sell your items.'], 400);
            }

            $item = Item::create($param);

            foreach($request->properties as $val){
                ItemProperty::create([
                    'item_id' => $item->id,
                    'sub_property_value_id' => $val
                ]);
            }

            if (!empty($request->file('imgs'))) {
                $files = $request->file('imgs');
                if (!is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $val) {
                    if (!$val instanceof UploadedFile || !$val->isValid()) {
                        \Log::warning('Invalid or missing file upload.');
                        continue;
                    }

                    $extension = strtolower($val->getClientOriginalExtension());
                    
                    if ($extension === 'heic') {
                        
                        try {
                            // Convert HEIC to JPEG using Imagick
                            $realPath = $val->getRealPath();
                            if (!is_file($realPath)) {
                                throw new \Exception("The uploaded file path is not a valid file: $realPath");
                            }
                            // Ensure Imagick is availab
                            $imagick = new \Imagick();
                            $imagick->readImage($val->getRealPath());
                            $imagick->setImageFormat('jpeg');

                            $finalTempPath = tempnam(sys_get_temp_dir(), 'heic_') . '.jpg';
                            $imagick->writeImage($finalTempPath);
                            $imagick->clear();
                            $imagick->destroy();

                            // Now upload $finalTempPath directly
                            $convertedFile = new UploadedFile(
                                $finalTempPath,
                                pathinfo($val->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg',
                                'image/jpeg',
                                null,
                                true
                            );

                            $path = Storage::disk('s3')->putFile('items', $convertedFile);

                            @unlink($finalTempPath);
                            $url = Storage::disk('s3')->url($path);

                            
                        } catch (\Exception $e) {
                            \Log::error("HEIC conversion failed: " . $e->getMessage());
                            continue;
                        }
                    } else {
                        // For JPEG, PNG, etc. — upload directly
                        $path = Storage::disk('s3')->putFile('items', $val);
                    }

                    $url = Storage::disk('s3')->url($path);

                    ItemImage::create([
                        'item_id' => $item->id,
                        'image_url' => $url,
                    ]);
                }
            }
            
            // if(!empty($request->file('imgs'))){
            //     foreach($request->file('imgs') as $val){
            //         // Save the file in S3 Storage
            //         $path = Storage::putFile('items', $val);
            //         // Get the URL
            //         $url = Storage::url($path);
            //         // Save to database
            //         ItemImage::create([
            //             'item_id' => $item->id,
            //             'image_url' => $url
            //         ]);
            //     }
            // }
            
          
            DB::commit();

            return response([
                'data' => $item,
                'message' => 'Successfully Added! Please wait for the item confirmation of admin.',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Show items by uuid
     *
     * @param  mixed $item
     * @return void
     */
    protected function show(Item $item)
    {
        try {
            $subCategory = SubCategoryProperty::where('sub_category_id', $item->sub_category_id)->get();

            $data = $subCategory->map(function ($props) use ($item) {
                return  [
                    'properties' => $props->name,
                    'values' => SubCategoryPropertyValue::where('sub_category_property_id', $props->id)->whereIn('id', $item->itemProperty->pluck('sub_property_value_id'))->get()
                ];
            });

            $comments = ItemComment::with('user')->where('item_id', $item->id)->get();

            return response(['item_details' => new ItemResource($item), 'item_property_details' => $data, 'item_comments' => $comments], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }

    }

    protected function featured(Request $request)
    {
        // for page size in pagination
        $size = $request->size ?: 10;

        try {
            $data = Item::with('subCategory','user')->where('status', Item::STATUS_PUBLISHED)->where('is_featured', 1)
            ->orderBy('item_name', 'asc')
            ->paginate($size);

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Delete items by uuid
     *
     * @param  mixed $item
     * @return void
     */
    protected function delete(Item $item)
    {
        try {

            $item->delete();

            return response(['data' => $item, 'message' => "Successfully Deleted"], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }

    }

     /**
     * Update item by uuid
     *
     * @param  mixed $item
     * @return void
     */
    protected function update(UpdateItemRequest $request, Item $item)
    {
        #Validate
        $param = $request->validated();
        DB::beginTransaction();
        try {
            $item->update($param);

            DB::commit();

            return response(['data' =>  $item, 'message' => 'Item Successfully updated.'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }

    }
}
