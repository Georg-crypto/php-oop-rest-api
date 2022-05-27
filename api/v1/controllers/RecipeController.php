<?php

    class RecipeController extends BaseController
    {

        private $recipeModel;
        private $authModel;

        public function __construct()
        {
            $this->recipeModel = new Recipe();
            $this->authModel = new Auth();
        }

        public function main($id = 0)
        {
            if(!isset($_GET['token'])) {
                return $this->showBadRequest();
            }
            $token = $_GET['token'];
            if(!$this->authModel->checkToken($token)) {
                return $this->showNotAuthorized();
            }
            $method = $_SERVER['REQUEST_METHOD'];
            switch ($method) {
                case 'GET':
                    $this->get($id);
                    break;
                case 'POST':
                    $this->post();
                    break;
                case 'PATCH':
                    $this->patch($id);
                    break;
                case 'DELETE':
                    $this->remove($id);
                    break;
                default:
                    $this->showNotAllowed();
            }
        }

        private  function get($data)
        {
            if (!empty($data)) {
                $id = $data[0];
                $this->answer = $this->recipeModel->getById($id);
                $this->sendAnswer();
            } else {
                $this->answer = $this->recipeModel->getAll();
                $this->sendAnswer();
            }
        }

        private  function post()
        {
            $data = json_decode(file_get_contents("php://input"), true) ;
            $this->answer = $this->recipeModel->add($data);
            $this->sendAnswer();
        }

        private  function patch($id)
        {
                $data = array(
                    'recipe_title' => 'Суп4',
                    'recipe_description' => 'Борщ4'
                );
                $this->answer = $this->recipeModel->edit($id, $data);
                $this->sendAnswer();
        }

        private  function remove($id)
        {
            $this->answer = $this->recipeModel->remove($id);
            $this->sendAnswer();
        }

    }
