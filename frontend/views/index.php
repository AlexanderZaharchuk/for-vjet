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
