<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Models\Item;
use App\Models\ItemProperty;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Item\ItemResource;
use Illuminate\Support\Facades\Storage;
use App\Models\ItemImage;

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
            $data = Item::with('user')->when(!empty($request->sub_category_id), function ($q) use ($request) {
                $q->where('sub_category_id', $request->sub_category_id);
            })
            ->when(!empty($request->filter['properties']), function ($q) use ($request) {
                $q->whereHas('itemProperty', function ($q1) use ($request) {
                    $q1->whereIn('sub_property_value_id', explode(',',$request->filter['properties']));
                });
            })
            ->when(!empty($request->filter['keyword']), function ($q) use ($request) {
                $q->where('item_name','LIKE','%'.$request->filter['keyword'].'%')
                ->orWhere('item_description', 'LIKE','%'.$request->filter['keyword'].'%');
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
            $param['user_id'] = auth()->user()->id;
            $item = Item::create($param);

            foreach($request->properties as $val){
                ItemProperty::create([
                    'item_id' => $item->id,
                    'sub_property_value_id' => $val
                ]);
            }
            if(!empty($request->file('imgs'))){
                foreach($request->file('imgs') as $val){
                    // Save the file in S3 Storage
                    $path = Storage::putFile('items', $val);
                    // Get the URL
                    $url = Storage::url($path);
                    // Save to database
                    ItemImage::create([
                        'item_id' => $item->id,
                        'image_url' => $url
                    ]);
                }
            }
          
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

            return response(['item_details' => new ItemResource($item), 'item_property_details' => $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }

    }
}
