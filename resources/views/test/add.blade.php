<html>
@extends('layouts.layout')
@section('content')
<h1>悩みを投稿してください</h1>

<body>
    <form action="/test/add" method="post">
        <table>
            @csrf
            <tr>
                <th>title: </th>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <th>main: </th>
                <td><input type="textarea" name="main"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="send"></td>
            </tr>
        </table>
    </form>
</body>
@endsection

</html>