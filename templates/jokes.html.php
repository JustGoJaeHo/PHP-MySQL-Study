<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>유머 글 목록</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p>
            <?=$error?>
        </p>
    <?php else: ?>
    <?php foreach ($jokes as $joke): ?>
        <blockquote>
            <p>
                <?=htmlspecialchars($joke, ENT_QUOTES, 'UTF-8')?>
            </p>
        </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>