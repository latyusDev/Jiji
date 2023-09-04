<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::with('orders.buyer.address')
                   ->where('is_sold',false)
                   ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $itemData = $request->validated();
        $itemData['image'] = asset('/storage/'.$request->file('image')
                             ->store('images','public'));
        $item = auth()->user()->items()
                      ->create($itemData);
        return $item;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Item::with('orders.buyer.address')
                   ->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->all());
        return response(['message'=>'item updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response(['message'=>'item deleted']);
    }
}
