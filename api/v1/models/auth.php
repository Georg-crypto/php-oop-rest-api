<?php

    class Auth extends BaseModel
    {
        public function checkApplication($applicationId, $applicationKey)
        {
            $query = "
                SELECT *
                FROM `applications`
                WHERE `application_id` = $applicationId
                    AND `application_key` = $applicationKey;
            ";
            $result = mysqli_query($this->connect, $query);
            return mysqli_num_rows($result);
        }

        public function checkToken($token)
        {
            $query = "
                SELECT *
                FROM `applications`
                WHERE `application_token` = '$token';
            ";
            $result = mysqli_query($this->connect, $query);
            return mysqli_num_rows($result) === 1;
        }

        public function addToken($applicationId, $token)
        {
            $query = "
                UPDATE `applications`
                    SET `application_token` = '$token'
                    WHERE `application_id` = $applicationId;
            ";
            return mysqli_query($this->connect, $query);
        }
    }