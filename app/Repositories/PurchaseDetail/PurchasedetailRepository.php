<?php

namespace App\Repositories\PurchaseDetail;
use App\PurchaseDetail;
use App\Cart;

class PurchasedetailRepository implements PurchasedetailRepositoryInterface
{
//購入詳細テーブルに挿入する処理
    public function InsertPurchasedetail($cart,$purchasepast){
        $purchaseDetail = app(PurchaseDetail::class); 
        $purchaseDetail->item_id = $cart->item_id;
        $purchaseDetail->price = $cart->item->price;
        $purchaseDetail->amount = $cart->amount;
        $purchaseDetail->purchase_past_id = $purchasepast->id;
        $purchaseDetail->save();
    }


}