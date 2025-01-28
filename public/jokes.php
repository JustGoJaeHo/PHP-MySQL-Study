<?php
    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';
        
        $jokes = allJokes($pdo);
        
        $title = '유머 글 목록';

        $totalJokes = totalJokes($pdo);

        // 버퍼 저장 시작
        ob_start();

        include __DIR__ . '/../templates/jokes.html.php';

        // 출력 버퍼의 내용을 읽고 변수에 저장한다.
        $output = ob_get_clean();

    } catch (PDOException $e) {
        $title = '오류가 발생했습니다';

        $output = '데이터베이스 오류: ' .
        $e->getMEssage() . ', 위치: ' .
        $e->getFile() . ':' .
        $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';
?>