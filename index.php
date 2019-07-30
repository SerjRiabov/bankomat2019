<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="handler.php">
        <h3>Введіть суму для зняття:</h3>
        <input type="text" name="sum">
        <br>
        <br>
        <input type="submit" value="Зняти готівку">
    </form>
<?php
if (file_exists("data.json")) {
    $handle = fopen('data.json', 'rb');
    $str = fread($handle, filesize('data.json'));
    fclose($handle);
    $data = json_decode($str, true);
}
    include "table.php";
    printTable($data);
?>
</body>
</html>