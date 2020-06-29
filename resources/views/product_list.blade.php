
@extends('layouts.default')

@section('title',$title)

@section('content')




@foreach($items as $item)
    @if($item->status ===1)
        <ul>
            <li><img src="{{ asset('storage/photos/' . $item->image) }}"></li>
            <li>{{ $item->price }}</li>
            <li>{{ $item->name }}</li>
            <form method = "post" action="{{url('/product_list/'.$item->id) }}">
                {{ csrf_field() }}

                @if($item->stock >0 )
               
                    <button type="hidden" name ="item_id" >カートに追加</button>
                @else
                    <p>売り切れ</p>
                @endif

            </form>

        </ul>


    @endif
@endforeach

@endsection