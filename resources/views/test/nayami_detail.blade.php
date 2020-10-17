<html>
<head>
<style>
    body {font-size:16pt; color:#999;}
    h1 {font-size:50pt; text-align:right; color:#f6f6f6;
        margin:-20px 0px -30px 0px; letter-spacing:-4pt;}

    th {background-color:#999; color:fff; padding:5px 10px;}
    td {border: solid 1px #aaa; color:#999; padding:5px 10px;}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<h1>{{$question->main}}</h1>


<h3>悩める子羊にアドバイス (要ログイン)</h3>
<form method="post">
@csrf
    <textarea rows="10" cols="80" name="content" class="form-control" required placeholder="アドバイスを入力してください"></textarea>
    <br>
    <input type="hidden" name="question_id" value="{{$question->id}}">
    <input type="submit" value="送信">
    <input type="reset" value="リセット">
    </br>
</form>


<h3>アドバイス一覧(クリックでその人のマイページ飛ぶ)</h3> 
<table>
    <form action="/test/mypage" method="post">
        @csrf
        @foreach($answer_questions as $answer_question)
        <tr>
        <td>{{$answer_question->user_id}}</td>  
        <td><input type="submit" name="id" value="{{$users->find($answer_question->id)->user->name}}"></td>
        <td>{{$answer_question->content}}</td>
        <td>
            @if($likes->where('user_id',Auth::user()->id)->where('answer_question_id',$answer_question->id)->first())
            <p>うんこif</p>
            <p class="favorite-marke">
                <a class="js-like-toggle loved" href="" data-answerquestionid="{{$answer_question->id}}">
                    <i class="fas fa-heart"></i>
                </a>
                <span class="likesCount">{{$answer_question->answer_question_likes_count}}</span>
            </p>

            @else
            <p>うんこelse</p>
            <p class="favorite-marke">
                <a class="js-like-toggle" href="" data-answerquestionid="{{ $answer_question->id }}">
                    <i class="far fa-heart"></i>
                </a>
                <span class="likesCount">{{$answer_question->answer_question_likes_count}}</span>
            </p>
            @endif
        </td>
        </tr>
        @endforeach
    </form>
</table>


<script src="{{ mix('js/_answerquestionlike.js') }}"></script>
</body>
</html>