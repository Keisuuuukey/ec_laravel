@extends('layouts.default')

@section('title',$title)

@section('content')

<h1>購入詳細一覧</h1>
<table>
    <tr>
        <th>商品名</th>
        <th>購入価格</th>
        <th>購入数</th>
        <th>合計金額</th>

    </tr>
    <tr>
        <td>{{$purchasedetail->item->name}}</td>
        <td>{{$purchasedetail->price }}</td>
        <td>{{$purchasedetail->amount}}</td>
        <td>{{$purchasedetail->price*$purchasedetail->amount}}</td>
    </tr>
</table>
@endsection