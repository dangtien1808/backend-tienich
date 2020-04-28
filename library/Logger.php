<?php
class Logger
{
    public static function writeLog($tblName, $data)
    {
        $db = new DataBase;
        $lstKey = array();
        $lstVal = array();
        foreach ( $data as $key => $val) {
            array_push($lstKey,  "`" . $key . "`");
            array_push($lstVal, "'" . $val . "'");
        }
        $sql = "insert into `". $tblName . "` (" . join( ", ", $lstKey) . ") values (" . join( ", ", $lstVal) . ")";
        $db->execute($sql);
    }
}