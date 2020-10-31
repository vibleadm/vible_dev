<html>
@extends('layouts.layout')
@section('content')
<div class="outer">
    <div class="inner1">
        <h1>悩みを記入して送信</h1>
    </div>
    <br>
    <div class="inner2">
        <form action="/test/add" method="post">
            <table>
                @csrf
                <tr>
                    <th>title: </th>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <th>main: </th>
                    <td>
                        <textarea rows="10" cols="80" name="main" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                    <td><input type="submit" value="send"></td>
                    </th>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection

</html>