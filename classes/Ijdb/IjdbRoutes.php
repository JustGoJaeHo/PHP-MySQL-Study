<?php
    namespace Ijdb;

    class IjdbRoutes implements \Hanbit\Routes {
        public function getRoutes() {
            include __DIR__ . '/../../includes/DatabaseConnection.php';

            $jokesTable = new \Hanbit\DatabaseTable($pdo, 'joke', 'id');
            $authorsTable = new \Hanbit\DatabaseTable($pdo, 'author', 'id');

            $jokeController = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);

            $routes = [
                'joke/edit' => [
                    'POST' => [
                        'controller' => $jokeController,
                        'action' => 'saveEdit'
                    ],
                    'GET' => [
                        'controller' => $jokeController,
                        'action' => 'edit'
                    ]
                ],
                'joke/delete' => [
                    'POST' => [
                        'controller' => $jokeController,
                        'action' => 'delete'
                    ]
                ],
                'joke/list' => [
                    'GET' => [
                        'controller' => $jokeController,
                        'action' => 'list'
                    ]
                ],
                '' => [
                    'GET' => [
                        'controller' => $jokeController,
                        'action' => 'home'
                    ]
                ]
            ];
    
            return $routes;
        }
    }
?>