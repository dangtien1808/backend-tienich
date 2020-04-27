<?php
class Logger
{

    function write($message)
    {
        $log  = "User: ".date("F j, Y, g:i a").$message;
        //Save string to log, use FILE_APPEND to append.
        file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
    }
}