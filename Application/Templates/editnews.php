<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <title>Редактирование новости</title>
    <meta name="description" content="Список последних новостей">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
        <textarea name="title" rows="2" cols="50"><?php echo $article->title; ?></textarea><br>
        <textarea name="lead" rows="10" cols="50"><?php echo $article->lead; ?></textarea><br>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>