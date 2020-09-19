<html>

<style>
    body {font-size:16pt; color:#999;}
    h1 {font-size:50pt; text-align:right; color:#f6f6f6;
        margin:-20px 0px -30px 0px; letter-spacing:-4pt;}

    th {background-color:#999; color:fff; padding:5px 10px;}
    td {border: solid 1px #aaa; color:#999; padding:5px 10px;}
</style>


<body>
<table>
    <tr><th>id: </th><td>{{$item->id}}</td></tr>
    <tr><th>name: </th><td>{{$item->name}}</td></tr>
    <tr><th>mail: </th><td>{{$item->mail}}</td></tr>
    <tr><th>age: </th><td>{{$item->age}}</td></tr>
</table>

</body>
</html>