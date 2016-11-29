<article>
    <header>
        <h1><?= $record['autor'] ?></h1>
    </header>
    <p style="width: 600px"><?= $record['text'] ?></p>
    <?= date("Y-m-d H:i:s", $record['created_at']) ?>
</article><hr>
