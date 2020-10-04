<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
@foreach($posts as $post)
<p>{{$post}}</p>
<p>{{$like_model}}</p>
@if($like_model->where('user_id',Auth::user()->id)->where('post_id',$post->id))
<p>うんこいいね済み</p>
<p class="favorite-marke">
  <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
  <span class="likesCount">{{$post->likes_count}}</span>
</p>
@else
<p>うんこいいねまだ</p>
<p class="favorite-marke">
  <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
  <span class="likesCount">{{$post->likes_count}}</span>
</p>
@endif​
@endforeach

<script src="{{ asset('js/_ajaxlike.js') }}"></script>
</body>