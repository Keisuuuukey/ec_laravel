
@extends('layouts.default')

@section('title',$title)


@section('content')
    <h1>{{$title}}</h1>

    @foreach($errors->all() as $error)
    <p class="error">{{ $error }}</p>
    @endforeach

    <form method="post" action="{{ url('/ec_form/store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div>
            <label>
                名前:
                <input type="text" name="name" class="name_field" placeholder="商品名を入力">
            </label>

        </div>

        <div>
            <label>
                値段：
                <input type="text" name="price" class="comment_field" placeholder="価格を入力">
            </label>
        </div>

        <div>
            <label>
                在庫数：
                <input type="text" name="stock" class="comment_field" placeholder="在庫数を入力">
            </label>
        </div>

        <div>
            <label>
                画像：
                <input type="file" name="image">
            </label>
        </div>

        <div>
            <label>
                ステータス：
                <select name = "status">
                    <option value="1">公開</option>
                    <option value="0">非公開</option>
                </select>
            </label>
        </div>
        <div>
            <input type="submit" value="投稿">
        </div>
    </form>

    <table>
        <tr>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>ステータス</th>
        <th>操作</th>
        </tr>

        @foreach($items as $item)
            <tr>
            <td>
            @if (isset($item->image))
                <img src="{{ asset('storage/photos/' . $item->image) }}">
                <br>
            @endif
            </td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->price }}</td>
            <td>
            <form method = "post" action="{{url('/ec_form/stock') }}">
                {{ csrf_field() }}
                <input type="hidden" name ="item_id" value="{{ $item->id }}">
                <input type = "text" name = "stock" value="{{ $item->stock }}">
                <input type="submit" value = "在庫数変更">

            </form>
            </td>
            <td>
            <form method = "post" action="{{url('/ec_form/status') }}">
                {{ csrf_field() }}
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                @if($item->status)
                    <button type ="hidden" name ="status" value="0">公開から非公開へ</button>
                @else
                    <button type ="hidden" name ="status" value="1">非公開から公開へ</button>
                @endif
                
             </form>
            
            </td>

            {{-- 削除ボタンを追加 --}}
            <td>
            <form method="post" action="{{url('/ec_form/destroy') }}">
                {{ csrf_field() }}
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="submit" value="削除">
            </form>
            </td>
            </tr>
        
        @endforeach
    </table>
    
@endsection
