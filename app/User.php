<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function carts() {
        return $this->hasMany('App\Cart');
    }

    //追記
    public function items() {
      return $this->belongsToMany(
        'App\Item', // 結びつけるモデル
        'carts', // 中間テーブル
        'user_id', // 中間テーブル内の自分のidのカラム名
        'item_id' // 中間テーブル内の相手のidのカラム名

      );
    }
    public function purchasePasts(){
        return $this->hasMany('App\PurchasePast');
    }
}


