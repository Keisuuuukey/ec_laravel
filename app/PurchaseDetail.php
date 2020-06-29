<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    //
    public function item(){
        return $this-> belongsTo('App\Item');
    }

    // public function get_item(){
    //     $item_name='';
    //     $item_price=0;
    //     $item_amount = 0;
    //     $total = 0;
    //     foreach($this->items as $item){
    //         $item_name = $item->name;
    //         $item_price = $item->price;
    //         $item_amount = $item->amount;
    //         $total = $item_price*$item_amount;
    //     }
    // }

    


}
