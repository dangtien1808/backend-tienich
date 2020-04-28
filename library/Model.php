<?php
class Model
{
    protected $tblName;
    protected $DB;
    function __construct ($tblName)
    {
        $this->tblName = $tblName;
        $this->DB = new DataBase();
    }
    function fetchAll()
    {
        $sql = "select * FROM {$this->tblName}";
        $result = $this->DB->fetchAll($sql);
        return $result;
    }

    function fetchId($id)
    {
        $sql = "select * FROM ". $this->tblName . " where id = :id";
        $result = $this->DB->fetch($sql, array("id" => $id));
        return $result;
    }
    function fetch($data)
    {
        $lstParams = array();
        foreach ( $data as $key => $val) {
            array_push($lstParams,  $key . " = '" . $val . "' ");
        }
        $sql = "select * FROM ". $this->tblName . " where " . join( "and ", $lstParams);
        $result = $this->DB->fetch($sql);
        return $result;
    }
}