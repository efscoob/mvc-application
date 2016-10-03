<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE-edge">
    <title></title>
    <meta name="description" content="Список последних новостей">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
<?php
    foreach($news as $obj) {
        echo "<a href='article.php?id={$obj->id}'>{$obj->title}</a>";
        echo "<p>$obj->news</p>";
    }
?>
</body>
</html>