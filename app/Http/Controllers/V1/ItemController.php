<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function index(Request $request)
    {
        $paginate = $request->paginate;
        $item = $this->item
            ->with('category')
            ->paginate($paginate);

        return ItemResource::collection($item);
    }


    public function store(ItemRequest $request)
    {
        $item = Item::create($request->all());

        return response()->json(['message' => 'Item created successfully!'], 201);
    }
}
