<?php
    try
    {
        include __DIR__ . '/../includes/autoload.php';

        $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

        $entryPoint = new \Hanbit\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Ijdb\IjdbRoutes());
        $entryPoint->run();
    }
    catch (PDOException $e)
    {
        $title = '오류가 발생했습니다';

        $output = '데이터베이스 오류: ' .
        $e->getMEssage() . ', 위치: ' .
        $e->getFile() . ':' .
        $e->getLine();

        include __DIR__ . '/../templates/layout.html.php';
    }
?>