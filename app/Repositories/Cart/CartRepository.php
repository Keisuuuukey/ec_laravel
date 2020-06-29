<?php

namespace App\Repositories\Cart;

use App\Cart;

class CartRepository implements CartRepositoryInterface
{
    public function CartInsertamount($user_id, $item_id)
    {
        
        $cart = app(Cart::class);
        $cart->user_id = $user_id;
        $cart->item_id = $item_id;
        $cart->amount = 1;
        $cart->save();
    }

    public function CartPlusamount($user_id, $item_id)
    {
        
        $cart = app(Cart::class);
        $cart = $cart->where('user_id', $user_id)->where('item_id', $item_id)->first();
        $cart->amount += 1;
        $cart->save();
    }

    public function Cartchangeamount($request)
    {
        $cart = app(Cart::class);//インスタンス生成
        $carts = $cart->where('item_id', $request->item_id)->first();
        $carts->amount = $request->amount;//itemオブジェクトのamountに値を代入
        $carts->save();

    }

    public function Cartdelete($cart){
        $cart->delete();
    }

    






    


}