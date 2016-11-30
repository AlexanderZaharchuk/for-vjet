<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Мини-блог</title>
    <style>
        body{
            background:#E96D65;
        }
    </style>
</head>
<body>
    <article>
        <header>
            <h1><?= $review['autor'] ?></h1>
        </header>
        <p style="width: 600px"><?= $review['text']?></p>
        <?= date("Y-m-d H:i:s", $review['created_at']) ?>
    </article><hr>
    <b>Комментарии:</b>

    <?php foreach ($record as $key => $value): ?>
    <article>
        <header>
            <h1><?= $value['autor_reviewer'] ?></h1>
        </header>
        <p style="width: 600px"><?= $value['text_reviewer'] ?></p>
    </article><hr>
    <?php endforeach; ?>

    <form name="create_review" method="post" action="/frontend/reviews/create?id=<?= $review['id'] ?>">
        <p><b>Ваше имя:</b><br>
            <input name="autor_reviewer" type="text" size="40">
        </p>
        <p>Комментарий<Br>
            <textarea name="text_reviewer" cols="40" rows="3"></textarea></p>
        <p><input type="submit" value="Отправить">
            <input type="reset" value="Очистить"></p>
    </form>

</body>
</html>
