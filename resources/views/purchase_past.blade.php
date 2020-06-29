@extends('layouts.default')

@section('title',$title)

@section('content')

<h1>購入履歴一覧</h1>

<table>

<tr>
    <th>注文番号</th>
    <th>購入日時</th>
    <th>該当の注文の合計金額</th>
    <th>購入詳細</th>
</tr>

@foreach($purchasepasts as $purchasepast)
<tr>
    <td>{{$purchasepast->id}}</td>
    <td>{{$purchasepast->created_at}}</td>
    <td>{{$purchasepast->get_total()}}</td>
    <td>
        <form metnd = 'post' action="{{url('/purchasedetail/'. $purchasepast->id)}}">
            {{ csrf_field() }}
            <button type = "submit" name ="past_id" value="{{$purchasepast->id}}">購入画面詳細</button>
        </form>
    </td>
</tr>
@endforeach

</table>




@endsection