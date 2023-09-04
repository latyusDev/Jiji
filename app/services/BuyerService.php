<?php
namespace App\Services;

use App\Models\Address;
use App\Models\Buyer;
use App\Models\Order;

class BuyerService{

    public function order($buyerData,$item)
    {   
        $buyerDetails = $this->buyerData($buyerData);
        $buyer = Buyer::create($buyerDetails);
        
        $buyerAddress = $this->buyerAddress($buyerData);
        $buyerAddress['addresable_type'] = Buyer::class;
        $buyerAddress['addresable_id'] = $buyer->id;
        Address::create($buyerAddress);

        $order = Order::create([
             'quantity'=>$buyerData['quantity'],
             'seller_id'=>$item->user_id,
             'item_id'=>$item->id,
             'buyer_id'=>$buyer->id,
         ]);
         $item->decreaseAvailableQuantity($item,$buyerData['quantity']);
         return $order;
    }

    private function buyerData($buyerData)
    {
        return [
            'first_name'=>$buyerData['first_name'],
            'last_name'=>$buyerData['last_name'],
            'email'=>$buyerData['email']
        ];
    }

    private function buyerAddress($buyerData)
    {
        return [
            'state'=>$buyerData['state'],
            'street'=>$buyerData['street'],
            'local_government'=>$buyerData['local_government']
        ];
    }
    
}