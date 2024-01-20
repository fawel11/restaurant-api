<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    protected $discount;

    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    public function index(Request $request)
    {
        $paginate = $request->paginate;
        $discount = $this->discount
            ->paginate($paginate);

        return DiscountResource::collection($discount);
    }


    public function store(DiscountRequest $request)
    {

        $discount = Discount::create($request->all());

        return response()->json(['message' => 'Discount created successfully', 'data' => $discount], 201);
    }

    public function update(DiscountRequest $request, Discount $discount)
    {

        $discount->update($request->all());

        return response()->json(['message' => 'Discount updated successfully', 'data' => $discount]);
    }
}
