@extends('layouts.default')

@section('title',$title)

@section('content')



<h1>購入完了しました</h1>

<table>
    <tr>
        <th>画像</th>
        <th>商品名</th>
        <th>値段</th>
        <th>数量</th>
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
        <td>{{$cart->amount}}</td>
    </tr>





@empty
<tr>
    <td colspan="4">商品がありません</td>
</tr>


@endforelse

</table>

<h3>合計金額:{{$total}}</h3>

<a href = "{{url('/product_list')}}"></a>

@endsection