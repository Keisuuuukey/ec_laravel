<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Cart_stock;

use Illuminate\Support\Facades\Auth;
use App\services\CartManagementService;

use App\PurchasePast;
use App\PurchaseDetail;
use App\Item;
use App\User;
use App\Cart;
use DB;

class CartsController extends Controller
{
    protected $CartManagementService;
    public function __construct(CartManagementService $CartManagementService)
    
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
        $this->cart_management = $CartManagementService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//カートの中身を表示
    {
        //
        $user = Auth::user();//ユーザー獲得
        
        $carts = $this->cart_management->get_cart($user);
        

        
        $title ='cart一覧';
        return view('cart',[
            'title'=>$title,
            'carts'=>$carts,
            'user'=>$user,
        ]);


    }

    // public function add($item_id){
    //     $user = Auth::user();
    //     $this->add_to_cart($user, $item_id);
    //     //cart_management_service
    //     return redirect('/items');
    //   }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Cart_stock $request)
    {
        //
        //$carts = \App\Cart::find($request->item_id);
        // $carts = \App\Cart::where('item_id',$request->item_id)->first();
    
        
        //     $carts->amount = $request->amount;//itemオブジェクトのamountに値を代入
        //     $carts->save();
        
        $this->cart_management->change_amount($request);
        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function purchase(){
        
        $user = Auth::user();//ユーザー獲得
        $del_carts=$this->cart_management->get_cart($user);
        $total = $this->cart_management->cal_total($del_carts);
        
        
        $title ='購入商品一覧';
        $carts = [];
        $carts = $this->cart_management->carts($del_carts);
        
        
        
        if($this->cart_management->cal_table($del_carts,$user,$total) === false){
             return redirect('/product_list');
        }
        
        
        return view('purchase_done',[
            'title'=>$title,
            'total'=>$total,
            'carts'=>$carts,

        ]);
    }

    public function purchasepast(){
        $user = Auth::user();
        $title = '購入履歴';
        
        $purchasepasts = $this->cart_management->get_purchasepast($user);
        //dd($purchasepasts);
        return view('purchase_past',[
            'title' => $title,
            'purchasepasts' => $purchasepasts,

        ]);

        
        
    }    
}
