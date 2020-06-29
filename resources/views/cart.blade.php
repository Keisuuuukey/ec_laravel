@extends('layouts.default')

@section('title',$title)

@section('content')



    <table>
        <tr>
            <th>画像</th>
            <th>商品名</th>
            <th>値段</th>
            <th>数量</th>
            <th>操作</th>
        </tr>
@forelse ($carts as $cart)
        <tr>
            <td>
                @if (!empty($cart->item->image))
                <img src="{{ asset('storage/photos/' . $cart->item->image) }}">
                <br>
            @endif
            </td>
            <td>{{$cart->item->name}}</td>
            <td>{{$cart->item->price}}</td>
            <td>
                <form method = "post" action = "{{url('/cart/amount') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name ="item_id" value="{{ $cart->item->id }}">
                    <input type = "text" name = "amount" value="{{ $cart->amount }}">
                    <input type="submit" value = "在庫数変更">

                </form>
               
            </td>
            <td>

            </td>
        </tr>


   
@empty
    <tr>
        <td colspan="4">商品がありません</td>
    </tr>

    
@endforelse

    </table>

    <form method = 'post' action = "{{url('/cart/purchase')}}">
        {{ csrf_field() }}
        <input type = "submit" value = "購入する">
    </form>
@endsection


