<?php

    class AuthController extends BaseController
    {
        private $authModel;

        public function __construct()
        {
            $this->authModel = new Auth();
        }

        public function main($id = 0)
        {
            $method = $_SERVER['REQUEST_METHOD'];
            switch ($method) {
                case 'GET':
                    $this->auth();
                    break;
                default:
                    $this->showNotAllowed();
            }
        }

        private function auth()
        {
            if(!isset($_GET['application']) || !isset($_GET['key'])) {
                return $this->showBadRequest();
            }
            $application = $_GET['application'];
            $key = $_GET['key'];
            $count = $this->authModel->checkApplication($application, $key);
            if($count === 0) {
                return $this->showNotAuthorized();
            }
            $helper = new Helper();
            $token = $helper->generateToken();
            $this->authModel->addToken($application, $token);
            $this->answer = array(
                'token' => $token
            );
            $this->sendAnswer();
        }


    }
