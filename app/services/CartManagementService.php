<?php

namespace App\Services;

use App\Cart;
use App\Item;
use App\Services\CartManagementService;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\PurchaseDetail\PurchasedetailRepositoryInterface;
use App\Repositories\Item\ItemRepositoryInterface;


use App\PurchasePast;
use App\PurchaseDetail;
use DB;

class CartManagementService {
    protected $cart_repository;
    protected $detail_repository;
    protected $item_repository;
    public function __construct(CartRepositoryInterface $cart_repository,PurchasedetailRepositoryInterface $detail_repository,ItemRepositoryInterface $item_repository){
        $this->cart_repository = $cart_repository;
        $this->detail_repository = $detail_repository; //ここの処理が何をしているのかが不明
        $this->item_repository = $item_repository;

    }


  public function add_to_cart($user,$user_id, $item_id){
    if( $user->carts->where('item_id', $item_id)->isEmpty() ){
        $this->cart_repository->CartInsertamount($user_id,$item_id);
      } else {
        // $cart = $user->carts->where('item_id', $item_id)->first();
        // $cart->amount += 1;
        $this->cart_repository->CartPlusamount($user_id,$item_id);
      }
      
    }
    public function get_cart($user){
        return $user->carts->all();
        
    }

    public function change_amount($request){
        $this->cart_repository->Cartchangeamount($request);
    }


    public function cal_total($del_carts){
        $total = 0;
        foreach($del_carts as $cart){
            //$carts[]=$cart->replicate();
            $total += $cart->item->price*$cart->amount;


        }
        return $total;

    }

    public function carts($del_carts){
        $carts = [];
        foreach($del_carts as $cart){
            $carts[]=$cart->replicate();
            
        }
        return $carts;

    }
    public function cal_table($del_carts,$user,$total)
    {
        
        $carts = [];
        $error = 0;

        $purchasepast = app(PurchasePast::class);
        $purchasepast->user_id = $user->id;

        if(count($del_carts)===0)
        {
            redirect('/product_list');
        }else{
            
             
            DB::beginTransaction();
            
            $purchasepast->save();

            foreach($del_carts as $cart)
            {
                // 在庫のチェック
                $stock = $cart->item->stock;
                $amount = $cart->amount;
                $result = $stock - $amount;//カートの数から在庫を引いたもの
                if ($result >= 0) {
                    
                    $this->detail_repository->InsertPurchasedetail($cart,$purchasepast);

                    $this->item_repository->Uploaditemamount($cart, $result);

                    $this->cart_repository->Cartdelete($cart);
                    DB::commit();
                }else{
                    $error = false;
                    
                    return $error;
                    
                    DB::rollback();

                }
                
                $carts[]=$cart->replicate();//stockの値の更新
            }
    }
}

    public function get_purchasepast($user){ //購入履歴一覧

        if($user->email = 'admin@admin.jp'){
            $purchasepast = \App\PurchasePast::all();
        }else{

            $purchasepast = $user->purchasePasts->all();//purchasepastテーブルの値をすベて獲得
        }
        return $purchasepast;
    }
    public function get_purchasedetail(){ //購入詳細一覧
        $purchasedetail = \App\PurchaseDetail::where('purchase_past_id',$purchasepast_id)->first();
    }
    public function insert_cart($item_id){
        $user = Auth::user();
        if( $user->carts->where('item_id', $item_id)->isEmpty() ){
            $this->Cart_repository->CartInsertamount($user->id,$item_id);

        }else{
            $this->Cart_repository->CartInsertamount($user->id,$item_id);
        }
    }

    

    
    


    

    }
