<?php
    namespace Hanbit;

    class EntryPoint
    {
        private $route;
        private $method;
        private $routes;
        
        public function __construct($route, string $method, \Hanbit\Routes $routes)
        {
            $this->route = $route;
            $this->method = $method;
            $this->routes = $routes;
            $this->checkUrl();
        }

        private function checkUrl()
        {
            if ($this->route !== strtolower($this->route))
            {
                http_response_code(301);
                header('location: ' . strtolower($this->route));
            }
        }

        private function loadTemplate($templateFileName, $variables = [])
        {
            extract($variables);
    
            ob_start();
    
            include __DIR__ . '/../../templates/' . $templateFileName;
    
            return ob_get_clean();
        }

        public function run()
        {
            $routes = $this->routes->getRoutes();

            $authentication = $this->routes->getAuthentication();

            if (isset($routes[$this->route]['login']) && $routes[$this->route]['login'] && !$authentication->isLoggedIn())
            {
                header('location: /login/error');
            }
            else
            {
                $controller = $routes[$this->route][$this->method]['controller'];
                $action = $routes[$this->route][$this->method]['action'];
    
                $page = $controller->$action();
    
                $title = $page['title'];
    
                if (isset($page['variables']))
                {
                    $output = $this->loadTemplate($page['template'], $page['variables']);
                }
                else
                {
                    $output = $this->loadTemplate($page['template']);
                }
    
                echo $this->loadTemplate('layout.html.php', [
                    'loggedIn' => $authentication->isLoggedIn(),
                    'title' => $title,
                    'output' => $output
                ]);
            }
        }
    }
?>