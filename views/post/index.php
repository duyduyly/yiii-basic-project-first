<h1>Post List</h1>

<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <?= $post['id'] ?> - <?= $post['title'] ?>
        </li>
    <?php endforeach; ?>
</ul>