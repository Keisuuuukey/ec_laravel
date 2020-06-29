<?php

//
namespace App\Http\Controllers;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\StockChangeRequest;

use App\services\CartManagementService;

use Illuminate\Http\Request;
use App\Services\ItemManagementService;


class EcController extends Controller
{
    protected $ItemManagementService;
    protected $CartManagementService;

    public function __construct(ItemManagementService $ItemManagementService,CartManagementService $CartManagementService)
    {
        $this->middleware('auth');
        //コンストラクタ生成
        $this->Item_management = $ItemManagementService;
        $this->cart_management = $CartManagementService;
    }


    //
    public function ec_action(){
        $title = 'ECサイトの商品管理ページ';
        
        $items = \App\Item::all();//1行でオブジェクトの生成とテーブルからの取り出しを行なっている
        return view('ec_form',[
            'title'=>$title,
            'items' =>$items,
        ]);
    }

    public function store(ItemRequest $request){
        $this->Item_management->add_store($request);
        return redirect('/ec_form');
    }

    public function destroy(Request $request){
        $this->Item_management->add_destroy($request);
        return redirect('/ec_form');
    }

    public function status(Request $request){
        $this->Item_management->add_status($request);
        return redirect('/ec_form');
    }

    public function stock(StockChangeRequest $request){
        $this->Item_management->add_stock($request);
        return redirect('/ec_form');
    }   
}
