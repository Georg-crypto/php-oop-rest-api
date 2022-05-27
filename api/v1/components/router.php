<?php

    class Router
    {
        private $routes;

        public function __construct()
        {
            require_once ("configs/routes.php");
            $this->routes = $routes;
        }

        public function run()
        {
            $requestedUrl = $_SERVER['REQUEST_URI'];

            foreach ($this->routes as $controller=>$paths) {

                foreach ($paths as $url=>$actionWithParameters) {
                    if(preg_match("~$url~", $requestedUrl)) {
                        $actionWithParameters = preg_replace("~$url~", $actionWithParameters,$requestedUrl);
                        $count = 1;
                        $actionWithParameters = str_replace(SITE_ROOT, '', $actionWithParameters, $count);
                        $actionWithParameters = explode('?', $actionWithParameters)[0];
                        $actionWithParametersArray = explode('/', $actionWithParameters);
                        $action = array_shift($actionWithParametersArray);
                        $requestedController = new $controller();
                        call_user_func_array(array($requestedController, $action), $actionWithParametersArray);
                        break 2;
                    }

                }
            }
        }
    }