<p>{{$post}}</p>
<h1>↑postID ↓likeID</h1>
<p>{{$like}}</p>



@if (Auth::check())
    @if ($like)
      {{ Form::model($post, array('action' => array('LikesController@destroy', $post->id, $like->id))) }}
        <button type="submit">
          <img src="/images/icon_heart_red.svg">
          Like {{ $post->likes_count }}
        </button>
      {!! Form::close() !!}
    @else
      {{ Form::model($post, array('action' => array('LikesController@store', $post->id))) }}
        <button type="submit">
          <img src="/images/icon_heart.svg">
          Like {{ $post->likes_count }}
        </button>
      {!! Form::close() !!}
    @endif
@endif