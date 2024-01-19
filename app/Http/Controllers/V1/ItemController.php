<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function store(ItemRequest $request)
    {
        $item = Item::create($request->all());

        return response()->json('Item created successfully!', 201);
    }
}
