<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PurchaseDetail;

class PurchaseController extends Controller
{

    public function purchaseDetail($past_id){
       
        $title = '購入詳細画面';
        $purchasedetails= \App\PurchaseDetail::where('purchase_past_id',$past_id)->first();
        // dd($purchasedetails->item());
        return view('purchase_detail',[
            'title'=>$title,
            'purchasedetail'=>$purchasedetails,
        ]);
    }
    
}
