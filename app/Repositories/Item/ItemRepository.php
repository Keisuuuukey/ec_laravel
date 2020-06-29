<?php

namespace App\Repositories\Item;

use App\Item;

class ItemRepository implements ItemRepositoryInterface
{
    //在庫数の変更
    public function Uploaditemamount($cart, $result)
    {
        $item = app(Item::class);
        $item = $item->find($cart->item_id);
        $item->stock = $result;
        $item->save();
    }
}