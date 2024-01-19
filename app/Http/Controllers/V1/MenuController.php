<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Item;
use App\Services\DiscountService;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }


    public function index(Request $request)
    {
        $items = Item::with('category', 'discounts')->paginate(10);


        $items->getCollection()->transform(function ($item) {
            $discountedAmount = $this->discountService->calculateDiscountedAmount($item);
            $item->computed_discount = $discountedAmount;
            return $item;
        });

        //return $items;

        return MenuResource::collection($items);

    }
}
