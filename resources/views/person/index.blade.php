<html>
<body>

<table>
<tr><th>NAME</th><th>Mail</th><th>Age</th></tr>
@foreach($items as $item)
    <tr>
        <td>{{$item->name}}</td>
        <td>{{$item->mail}}</td>
        <td>{{$item->age}}</td>
    </tr>
@endforeach
</table>

</body>
</html>