<?php

class Session
{
    public function setSession($key, $val, $time = null) {
        $_SESSION[$key] = array(
            $key => $val,
            "timeLast" => !is_null($time) ? $time : time()
        );
    }
    public function getSession($key){
        if(!$this->checkExistSession($key)) {
            return null;
        }
        $data = isset($_SESSION[$key][$key]) && $_SESSION[$key][$key] != null ? $_SESSION[$key][$key] : null;
        return $data;
    }
    public function checkExistSession ($key) {
        if(isset($_SESSION[$key])) {
            $data = $_SESSION[$key];
            if ($data["timeLast"] + MAX_AGE_SESSION >= time()) {
                $this->setSession($key, $data[$key]);
                return true;
            }
        }
        unset($_SESSION[$key]);
        return false;
    }
}
?>