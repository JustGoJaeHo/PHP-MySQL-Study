<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
</head>
<body>
    <header>
        <h1>인터넷 유머 세상</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="jokes.php">유머 글 목록</a></li>
        </ul>
    </nav>

    <main>
        <?=$output?>
    </main>
    
    <footer>
        &copy; IJDB 2025
    </footer>
</body>
</html>