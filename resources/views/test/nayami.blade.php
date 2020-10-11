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

<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@section('content')


<br>
<h2>投稿された悩み一覧(クリックで詳細とぶ)</h2>
<br>
<body>
<p><a href="/test/add" >ログインして悩みを投稿しよう</a></p>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">


<h3>
  <table>
    <form action="/test/mypage" method="post">
      @csrf
      @foreach($questions as $question)
        <tr>
        <td><a href="{{ action('QuestionController@detail', $question->id) }}">{{$question->title}}</a></td>
        <td>{{$question->user_id}}</td>
        <td><input type="submit" name="id" value="{{$users->find($question->id)->user->name}}"></td>
        <td>
            @if($likes->where('user_id',Auth::user()->id)->where('question_id',$question->id)->first())
            <p>うんこif</p>
            <p class="favorite-marke">
              <a class="js-like-toggle loved" href="" data-questionid="{{$question->id}}">
                <i class="fas fa-heart"></i>
              </a>
              <span class="likesCount">{{$question->question_likes_count}}</span>
            </p>

            @else
            <p>うんこelse</p>
            <p class="favorite-marke">
              <a class="js-like-toggle" href="" data-questionid="{{ $question->id }}">
                <i class="active far fa-heart"></i>
              </a>
              <span class="likesCount">{{$question->question_likes_count}}</span>
            </p>  
            @endif
        </td>
        </tr>
      @endforeach
    </form>
  </table>
</h3>

<script src="{{ mix('js/_questionlike.js') }}"></script>
</body>

@endsection