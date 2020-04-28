<?php
class Database
{

    private static $instance = NULL;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          self::$instance = new PDO('mysql:host='.DB_SERVERNAME.';dbname='
          .DB_NAME, DB_USERNAME, DB_PASSWORD);
          self::$instance->exec("SET NAMES 'utf8'");
         
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }
     
  // New features
  // 2020/01/04
  // API for execute sql command
  
    /**
     * [Executes a prepared statement]
     * @param  [type] $sql [description]
     * @param  array  $parameter [description]
     * @return [PDOstatement]   [ statement or result of execute TRUE on success or FALSE on failure. ]
     */
     static function execute($sql,$parameter=array()){
      $stm  = self::getInstance()->prepare($sql);
      $stm->execute($parameter);
      
      return $stm; 
    }
  
  /** [Execute sql command and fetchAll data ( table ) ]
   * @param  $sql command as argument for PDO->prepare()
   * @param  $parameter parameter array for PDO->execute()
   * @return PDO->fetchAll()
   */
     static function fetchAll($sql,$parameter=array()){
      return self::execute($sql,$parameter)->fetchAll(PDO::FETCH_ASSOC);
    }
  
  /** [Execute sql command and fetch data ( record ) ]
   * @param  $sql command as argument for PDO->prepare()
   * @param  $parameter parameter array for PDO->execute()
   * @return PDO->fetch()
   */
     static function fetch($sql,$parameter=array()){
      return self::execute($sql,$parameter)->fetch();
    }
}