<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
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
