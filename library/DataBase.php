<?php
class Database
{

  private $serveName;
  private $name;
  private $userName;
  private $password;

  private $conn = NULL;

    function __construct($serveName = DB_SERVERNAME,$name = DB_NAME,$userName = DB_USERNAME,$password = DB_PASSWORD)
    {
      $this->serveName  = $serveName;
      $this->name       = $name;
      $this->userName   = $userName;
      $this->password   = $password;   
      $this->getConnect();
    }

    public function getConnect() {
      if (!isset($this->conn)) {
        try {
          $this->conn = new PDO('mysql:host='. $this->serveName.';dbname='.$this->name, $this->userName, $this->password);
          $this->conn->exec("SET NAMES 'utf8'");
         
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
    }
     
  
    /**
     * [Executes a prepared statement]
     * @param  [type] $sql [description]
     * @param  array  $parameter [description]
     * @return [PDOstatement]   [ statement or result of execute TRUE on success or FALSE on failure. ]
     */
     function execute($sql,$parameter=array()){
      $stm  = $this->conn->prepare($sql);
      $stm->execute($parameter);
      
      return $stm; 
    }
  
  /** [Execute sql command and fetchAll data ( table ) ]
   * @param  $sql command as argument for PDO->prepare()
   * @param  $parameter parameter array for PDO->execute()
   * @return PDO->fetchAll()
   */
     function fetchAll($sql,$parameter=array()){
      return $this->execute($sql,$parameter)->fetchAll(PDO::FETCH_ASSOC);
    }
  
  /** [Execute sql command and fetch data ( record ) ]
   * @param  $sql command as argument for PDO->prepare()
   * @param  $parameter parameter array for PDO->execute()
   * @return PDO->fetch()
   */
     function fetch($sql,$parameter=array()){
      return $this->execute($sql,$parameter)->fetch();
    }
}