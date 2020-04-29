<?php
    class DataFormat {
        public function formatEmail($email)
        {
            return $email;
        }
        public function getIndex($index)
        {
            return isset($_GET["$index"]) ? $_GET["$index"] : NULL;
        }
        public function postIndex($index)
        {
            return isset($_POST["$index"]) ? $_POST["$index"] : NULL;
        }
    }
?>