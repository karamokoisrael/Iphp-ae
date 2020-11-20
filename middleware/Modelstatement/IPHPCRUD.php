<?php
namespace Model\Modelstatement;
/**
 *
 */
use Model\Modelstatement\{ModelClass as DB};
use Controller\Controller\AppController;

class IPHPCRUD extends ModelClass
{
  private $_db;
  private $_results;
  private $_tableName = null;
  private $_whereClose = null;
  protected $_colList = null;
  protected $_listValues = null;
  protected $_lastIdInsertedVal = null;
  protected $_sent = false;
  protected $_updated = false;

  public function __construct($db = null)
  {
    $this->_db = is_null($db) ?
    $this->_db = DB::DB_connection() :
    $this->_db = $db;
  }

public function create()
{
  $send = AppController::sqlSend(
  "INSERT INTO $this->_tableName
           SET $this->_colList",
               $this->_listValues,
               $this->_db
  );

  if ($send !== false) {
    $this->_lastIdInsertedVal = $send->lastInsertId();
    $this->_sent = true;
  }
}

public function created()
{
  return $this->_sent;
}

public function update()
{
  $update = AppController::sqlSend(

  "UPDATE $this->_tableName
      SET $this->_colList
    WHERE $this->_whereClose",
          $this->_listValues,
          $this->_db
  );

  if ($update !== false) {
    $this->_lastIdInsertedVal = $update->lastInsertId();
    $this->_updated = true;
  }
}

public function updated()
{
  return $this->_updated;
}

public function lastIdInsertedVal()
{
  return (int) $this->_lastIdInsertedVal;
}


public function tableName(string $name): self
{
  $this->_tableName = $name;
  return $this;
}

public function colList(string $colList): self
{
  $this->_colList = $colList;
  return $this;
}


public function values($args): self
{
  $this->_listValues = $args;
  return $this;
}


public function where($whereClose): self
{
  $this->_whereClose = $whereClose;
  return $this;
}

public function read()
{

  $fetch = AppController::sqlFetch(

  "SELECT $this->_colList
     FROM $this->_tableName
    WHERE $this->_whereClose",
          $this->_listValues,
          $this->_db
  );

  if ($fetch !== false)
      $this->_results = $fetch;
}

public function results()
{
  return $this->_results;
}

  /**
   * debuger method (for developpement process)
   */
  public static function debug($params)
  {
    echo "<pre>";
      print_r ($params, true);
    echo "</pre>";
  }
}
