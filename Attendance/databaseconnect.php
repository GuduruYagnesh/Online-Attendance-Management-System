<?php
    class Database{
        private $host = "localhost";
        private $dbName = "feedback2";
        private $username = "root";
        private $password = "";

        protected function getHost(){
            return $this->host;
        }
        protected function getDBName(){
            return $this->dbName;
        }
        protected function getUserName(){
            return $this->username;
        }
        protected function getPassword(){
            return $this->password;
        }
    }

?>