<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasePast extends Model
{
    //

    public function purchaseDetails(){
        return $this->hasMany('App\PurchaseDetail');
    }

    

    public function get_total(){
        $total =0;
        foreach($this->purchaseDetails as $purchaseDetail){
            $total += $purchaseDetail->price * $purchaseDetail->amount;
        }
        return $total;
    }
}
