<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuyerRequest;
use App\Models\Address;
use App\Models\Buyer;
use App\Models\Item;
use App\Models\Order;
use App\Services\BuyerService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(StoreBuyerRequest $request, Item $item)
    {
        $order = (new BuyerService())->order($request->validated(),$item);
        return $order;
    }
}
