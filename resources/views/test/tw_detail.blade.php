<html>

<h1>{{$item->main}}</h1>


<h3>コメント (要ログイン)</h3>
<form method="post">
@csrf
    <textarea rows="10" cols="80" name="main" class="form-control" required placeholder="アドバイスを入力してください"></textarea>
    <br>
    <input type="hidden" name="tweetID" value="{{$item->tweetID}}">
    <input type="submit" value="送信">
    <input type="reset" value="リセット">
</form><br>

<h3>コメント一覧(クリックでその人のマイページ飛ぶ)</h3>
<h2>
<table>


    <tr>
    <form name="otameshi" action="/test/mypage" method="post">
    @csrf
    @foreach($items2 as $item2)
        <td><input type="submit" name="id" value="{{$item2->userID}}"></td>
        <td><a href="/test/mypage" onclick="javascript:document.otameshi.submit();return false;">{{$item2->userID}}</a></td>
        <td>{{$item2->main}}</td>
        </tr>
    @endforeach
    </form>

</table>
</h2>


</html>
