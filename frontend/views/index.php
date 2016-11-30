<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Мини-блог</title>
    <style>
        <?php require_once '../web/css/text-slyder.css'; ?>
    </style>
</head>
<body>

    <div id="carousel">
        <div class="btn-bar">
            <div id="buttons"><a id="prev" href="#"><</a><a id="next" href="#">></a> </div></div>
        <div id="slides">
            <ul>
                <?php foreach ($topResult as $key => $value): ?>
                <li class="slide">
                    <div class="quoteContainer">
                        <p class="quote-phrase"><span class="quote-marks">"</span>
                            <?= $value['text'] ?>
                            <span class="quote-marks">"</span>

                        </p>
                    </div>
                    <div class="authorContainer">
                        <p class="quote-author"><?= $value['autor'] ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?php foreach ($records as $key => $value): ?>
        <article>
            <header>
                <h1><a href="/frontend/default/view?id=<?= $value['id'] ?>"><?= $value['autor'] ?></a></h1>
            </header>
            <p style="width: 600px"><?= $value['text'] ?></p>
            <p><b>Количество комментариев: </b><?= $value['comments'] ?></p>
            <?= date("Y-m-d H:i:s", $value['created_at']) ?>
        </article><hr>
    <?php endforeach; ?>

    <form name="create_post" method="post" action="/frontend/default/create">
        <p><b>Ваше имя:</b><br>
            <input name="name" type="text" size="40">
        </p>
        <p>Комментарий<Br>
            <textarea name="text" cols="40" rows="3"></textarea></p>
        <p><input type="submit" value="Отправить">
            <input type="reset" value="Очистить"></p>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        <?php require_once '../web/js/text-slyder.js'; ?>
    </script>
</body>
</html>
