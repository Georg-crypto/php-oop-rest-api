<?php

    class Recipe extends BaseModel
    {

        public function getAll()
        {
            $query = "
                SELECT * FROM `recipies`";
            $result = mysqli_query($this->connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        public function getById($id)
        {
            $query = "SELECT *
                      FROM `recipies`
                      WHERE `recipe_id` = $id";
            $result = mysqli_query($this->connect, $query);
            return mysqli_fetch_assoc($result);
        }

        public function add($data)
        {
            $query = "
                INSERT INTO `recipies`
                    SET `recipe_title` = '$data[title]',
                        `recipe_description` = '$data[description]';
                    ";
            return mysqli_query($this->connect, $query);
        }

        public function edit($id, $data)
        {
            //print_r($data);
            //exit;
            $query = "UPDATE `recipies`
                      SET `recipe_title` = '$data[recipe_title]',
                          `recipe_description` = '$data[recipe_description]'
                      WHERE `recipe_id` = $id
                      ";
            return mysqli_query($this->connect, $query);
        }

        public function remove($id)
        {
            $query = "
                DELETE FROM `recipies` WHERE `recipe_id` = $id;
                    ";
            return mysqli_query($this->connect, $query);
        }

    }
