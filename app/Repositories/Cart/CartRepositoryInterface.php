<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{

    public function CartInsertamount($user_id,$item_id);
    public function CartPlusamount($user_id,$item_id);
    public function Cartchangeamount($request);
    public function Cartdelete($cart);
}

