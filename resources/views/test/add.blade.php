<html>

<body>
    <form action="/test/add" method="post">
    <table>
        @csrf
        <tr><th>title: </th><td><input type="text" name="title"></td></tr>
        <tr><th>userID: </th><td><input type="text" name="userID"></td></tr>
        <tr><th>main: </th><td><input type="text" name="main"></td></tr>
        <tr><th></th><td><input type="submit" value="send"></td></tr>
    </table>
    </form>
</body>

</html>
