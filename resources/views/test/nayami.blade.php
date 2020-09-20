@extends('layouts.layout')
<!DOCTYPE html>
<html>
<head>
    <title>nayami</title>
    <style>
    body {font-size:16pt; color:#999;}
    h1 {font-size:50pt; text-align:right; color:#f6f6f6;
        margin:-20px 0px -30px 0px; letter-spacing:-4pt;}

    th {background-color:#999; color:fff; padding:5px 10px;}
    td {border: solid 1px #aaa; color:#999; padding:5px 10px;}
    </style>
</head>

@section('content')
<br>
<h2>投稿内容一覧(クリックで詳細とぶ)</h2>
<br>
<body>
<p><a href="/test/add" >ログインして悩みを投稿しよう</a></p>
</body>

<p>{{$like}}</p>

<h2>
<body>
	<table>
	@foreach($items as $item)
		<tr>
			<td><a href="{{ action('PostsController@show2', $item->qid) }}">{{$item->title}}</a></td>
			<td>{{$item->userID}}</td>
			<td>{{$item->liked}}</td>
			<td>
			@if($item->liked)
            <p>うんこif</p>
            {{ Form::model($item, array('action' => array('LikesController@destroy', $item->qid, $item->liked->id))) }}
                <button type="submit">
                Like {{ $item->likes_count }}
                </button>
            {!! Form::close() !!}
            @else
            <p>うんこelse</p>
            {{ Form::model($item, array('action' => array('LikesController@store', $item->qid))) }}
                <button type="submit">
                Like {{ $item->likes_count }}
                </button>
            {!! Form::close() !!}
            @endif
			</td>
		

		</tr>
	@endforeach
	</table>
</body>
</h2>





@endsection

</html>
