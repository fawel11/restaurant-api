<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Mutators\TypeMutator;

class DiscountController extends Controller
{

    protected $discount;
    protected $typeMutator;

    public function __construct(Discount $discount, TypeMutator $typeMutator)
    {
        $this->discount = $discount;
        $this->typeMutator = $typeMutator;
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
        $discount =$this->discount;

        $discount->value = $request->input('value');
        $discount->category_id = $request->input('category_id');
        $discount->item_id = $request->input('item_id');
        $discount->type = $this->typeMutator->mutateType($discount);
        $discount->save();

        return response()->json(['message' => 'Discount created successfully', 'data' => $discount], 201);
    }



}
