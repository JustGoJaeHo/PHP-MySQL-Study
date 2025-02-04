<?php
    function loadTemplate($templateFileName, $variables = []) {
        extract($variables);

        ob_start();

        include __DIR__ . '/../templates/' . $templateFileName;

        return ob_get_clean();
    }

    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

        if ($route == strtolower($route)) {
            if ($route === '') {
                include __DIR__ . '/../classes/controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->home();

            } else if ($route === 'joke/list') {
                include __DIR__ . '/../classes/controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->list();

            } else if ($route === 'joke/edit') {
                include __DIR__ . '/../classes/controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->edit();
                
            } else if ($route === 'joke/delete') {
                include __DIR__ . '/../classes/controllers/JokeController.php';
                $controller = new JokeController($jokesTable, $authorsTable);
                $page = $controller->delete();
                
            } else if ($route === 'register') {
                include __DIR__ . '/../controllers/RegisterController.php';
                $controller = new RegisterController($authorsTable);
                // $page = $controller->showForm();
            }

        } else {
            http_response_code(301);
            header('loaction: index.php?route' . strtolower($route));
        }

        $title = $page['title'];

        if (isset($page['variables'])) {
            $output = loadTemplate($page['template'], $page['variables']);
        } else {
            $output = loadTemplate($page['template']);
        }

    } catch (PDOException $e) {
        $title = '오류가 발생했습니다';

        $output = '데이터베이스 오류: ' .
        $e->getMEssage() . ', 위치: ' .
        $e->getFile() . ':' .
        $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';
?>