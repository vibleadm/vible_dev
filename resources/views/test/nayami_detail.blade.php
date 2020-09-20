<html>

<h1>{{$post->main}}</h1>


<h3>悩める子羊にアドバイス (要ログイン)</h3>
<form method="post">
@csrf
    <textarea rows="10" cols="80" name="main" class="form-control" required placeholder="アドバイスを入力してください"></textarea>
    <br>
    <input type="hidden" name="questionID" value="{{$post->qid}}">
    <input type="submit" value="送信">
    <input type="reset" value="リセット">
    </br>
</form>


<h3>アドバイス一覧(クリックでその人のマイページ飛ぶ)</h3>
<h2>
<table>


    <tr>
    <!--
    <form name="otameshi" action="/test/mypage" method="post">
    -->
    <form action="/test/mypage" method="post">
    @csrf
    @foreach($answers as $answer)
    <td><input type="submit" name="id" value="{{$answer->userID}}"></td>
    <!--
    <td><a href="/test/mypage" onclick="javascript:document.otameshi.submit();return false;">{{$answer->userID}}</a></td>
    -->
    <td>{{$answer->main}}</td>
    </tr>
    @endforeach
    </form>

</table>
</h2>


</html>