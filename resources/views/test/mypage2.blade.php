@extends('layouts.layout')

<!doctype html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="tab.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>


@section('content')
<div class="tab_item" id="item2">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/app.min.js?171029002" defer></script>
	<div class="col-xl-5 mb-2 mb-xl-0">
		<div class="mb-1 small text-danger"><span class="badge badge-danger ml-2"></span></div>
		<div><input type="textarea" name="title" class="form-control" required placeholder="タイトル入力欄"></div>
		<div><input type="textarea" name="main" class="form-control" required placeholder="vible入力欄"></div>
	</div>
	<div class="col-xl row">
		<input type="submit" value="投稿" class="btn btn-info mb-1">
		<input type="reset" value="クリア" class="btn btn-warning mb-1">
	</div>


    <br>
    <h2>vible一覧(クリックで詳細とぶ)</h2>
    <br>

    <h2>
	<body>
	<table>
	@foreach($items2 as $item)
		<tr>
			<td>{{$item->main}}</td>
			<td>{{$item->date}}</td>
		</tr>
	@endforeach
	</table>
	</h2>
    </table>
    </body>
</div>
@endsection