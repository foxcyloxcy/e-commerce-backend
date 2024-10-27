<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use Carbon\Carbon;

class UpdateFeaturedItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-featured-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update featured item';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now();

        $featuredItems = Item::where('is_featured',  1)->whereIn('status', [Item::STATUS_PENDING, Item::STATUS_PUBLISHED])->get();
        foreach ($featuredItems as $item) {
            // Convert the expiry date to a Carbon instance
            $expiryDate = Carbon::parse($item->featured_exp_date);

            // Check if the current date is greater than or equal to the expiry date
            if ($currentDate->greaterThanOrEqualTo($expiryDate)) {
                $item->is_featured = 0; // Make sure STATUS_EXPIRED is defined in your model
                $item->save();
            }
        }
    }
}
