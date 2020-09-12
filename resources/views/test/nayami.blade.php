<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>main画面</title>
</head>

<br>
<h2>投稿内容一覧(クリックで詳細とぶ)</h2>
<br>


<h2>
<body>
	<table>
	@foreach($items as $item)
		<tr>
			<td>{{$item->title}}</td>
			<td>{{$item->userID}}</td>
			<td>{{$item->main}}</td>
		</tr>
	@endforeach
	</table>
</h2>
</body>

</html>

