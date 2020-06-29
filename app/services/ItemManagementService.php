<?php

namespace App\Services;

use App\Item;
use App\Services\CartManagementService;
use Illuminate\Http\Request;

class ItemManagementService {

    public function add_store($request){
       
        $filename = '';
        $image = $request->file('image');
        if( isset($image) === true ){
            // 拡張子を取得
            $ext = $image->guessExtension();
            // アップロードファイル名は [ランダム文字列20文字].[拡張子]
            $filename = str_random(20) . ".{$ext}";
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->storeAs('photos', $filename, 'public');
        }

        // itemモデルを利用して空のitemオブジェクトを作成
        $item= new \App\Item;

        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->status = $request->status;
        $item->image = $filename;

        $item->save();
    }

    public function add_destroy($request){
        $item= \App\Item::find($request->item_id);
        $item->delete();
    }

    public function add_status($request){
        $item = \App\Item::find($request->item_id);
        if ($item->status) {
            $item->status = false;
        } else {
            $item->status = true;
        }
        $item->save();
    }

    public function add_stock($request){
        $item = \App\Item::find($request->item_id);
        $item->stock = $request->stock;//itemオブジェクトのstockに値を代入
        $item->save();
    }




}