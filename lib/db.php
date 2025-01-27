<?php
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8', 'ijdbuser', 'mypassword');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'SELECT `joketext` FROM `joke`';
        $result = $pdo->query($sql);

        while ($row = $result->fetch()) {
            $jokes[] = $row['joketext'];
        }
        
        $title = '유머 글 목록';

        $output = '';

        foreach ($jokes as $joke) {
            $output .= '<blockquote>';
            $output .= '<p>';
            $output .= $joke;
            $output .= '</p>';
            $output .= '</blockquote>';
        }
    } catch (PDOException $e) {
        $title = '오류가 발생했습니다.';

        $output = '데이터베이스 오류: ' .
        $e->getMEssage() . ', 위치: ' .
        $e->getFile() . ':' . $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';
?>