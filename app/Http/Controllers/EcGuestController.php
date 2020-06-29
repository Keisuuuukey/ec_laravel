<?php

namespace App\Http\Controllers;

use App\services\CartManagementService;

use Illuminate\Http\Request;

use App\Item;
use App\User;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class EcGuestController extends Controller
{
    private $cart_management;
    public function __construct(CartManagementService $cart_management)
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
        $this->cart_management = $cart_management;
    }
    //
    public function product_list(){
        $title = '商品一覧ページ';
        $items = Item::all();
        $user = Auth::user();
        return view('product_list',[
            'title'=>$title,
            'items' =>$items,
            'user'=>$user,
            
        ]);
    }

    public function add($item_id){
        $user = Auth::user();
        $this->cart_management->add_to_cart($user,$user->id,$item_id);
        return redirect('/product_list');
    } 
}
