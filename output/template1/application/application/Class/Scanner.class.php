<?php
/**
 *
 */
 use Model\Modelstatement\{ModelClass as DB};
 use Controller\Controller\AppController;

class Scanner
{

  private $_data, $_db, $_errors = [];
  protected $_entree = null;
  protected $_whereClose = null;
  protected $_errMessage = null;
  protected $_listValues = null;
  protected $_tableName = null;

  function __construct($data, $db = null)
  {
    $this->_data = $data;

    // SETTING DATABASE CONNECTION...
    $this->_db = is_null($db) ?
    $this->_db = DB::DB_connection() :
    $this->_db = $db;
  }

  // Test l'existence d'un champ
  private function field()
  {
    [$index] = func_get_args();

    if (!array_key_exists($index, $this->_data))
        IphpThrowError("errcd21213", $index);

    return $this->_data[$index];
  }

  public function errMessage($message): self
  {
    $this->_errMessage = $message;
    return $this;
  }

  public function verify($entree): self
  {
    $this->_entree = $entree;
    return $this;
  }

  public function where($whereClose): self
  {
    $this->_whereClose = $whereClose;
    return $this;
  }

  public function values(...$args): self
  {
    $this->_listValues = $args;
    return $this;
  }

  // Alpha simple (minuscule)
  public function isNotAlphaLC(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-z]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alpha simple (Majuscule)
  public function isNotAlphaUC(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[A-Z]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alpha simple (minuscule && || Majuscule)
  public function isNotAlphaBoth(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-zA-Z]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alpha simple plus accentués (minuscule)
  public function isNotAlphaAllLC(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-zâäàéèùêëîïôöçñ_\'\- ]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alpha simple plus accentués (Majuscule)
  public function isNotAlphaAllUC(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[A-Zâäàéèùêëîïôöçñ_\'\- ]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alpha simple plus accentués (minuscule && || Majuscule)
  public function isNotAlphaAllBoth(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-zA-ZâäàéèùêëîïôöçñÂÄÀÉÈÙÊËÎÏÔÖÇÑ_\'\- ]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Numérique
  public function isNotNum(): self
  {
    [$index, $errMsg] = func_get_args();

    if (preg_match('/^[\D]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique (minuscule)
  public function isNotAlphanumLC(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-z0-9]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique (Majuscule)
  public function isNotAlphanumUC(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[A-Z0-9]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique (minuscule && || Majuscule)
  public function isNotAlphanumBoth(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-zA-Z0-9]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique (minuscule && || Majuscule)
  public function isNotAlphanumWord(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[\w]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique plus accentués (minuscule)
  public function isNotAlphanumAllLC(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-zA-Z0-9âäàéèùêëîïôöçñ_\' ]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique plus accentués (Majuscule)
  public function isNotAlphanumAllUC(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[A-Z0-9âäàéèùêëîïôöçñ_\' ]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique plus accentués (minuscule && || Majuscule)
  public function isNotAlphanumAllBoth(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-zA-Z0-9âäàéèùêëîïôöçñÂÄÀÉÈÙÊËÎÏÔÖÇÑ_\' ]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique plus accentués (minuscule && || Majuscule)
  public function isNotLastName(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^([A-Z]?)([-a-zÂÄÀÉÈÙÊËÎÏÔÖÇÑâäàéèùêëîïôöçñ_\']){2,}+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique plus accentués (minuscule && || Majuscule)
  public function isNotFirstName(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^([A-Z]?)([-a-zÂÄÀÉÈÙÊËÎÏÔÖÇÑâäàéèùêëîïôöçñ_\']){2,}+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Alphanumérique plus accentués plus autres caractères
  public function isNotGeneralCharsType(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-zA-Z0-9âäàéèùêëîïôöçñÂÄÀÉÈÙÊËÎÏÔÖÇÑ!?"%,;:()<>=&œ@$*^+-_¨°#{}\' ]+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Numéro de téléphone (International)
  public function isNotPhoneNum(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match("/^([\+|00{2}]\d{1,3})?([-. ]?\d{2}){4,5}$/", $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Numéro de téléphone (International)
  public function isNotUsername(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[A-Za-z0-9_]+$/', $this->field($index)))
      $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Numéro de téléphone (International)
  public function isNotTweeterUsername(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^@([a-z0-9A-Z._-]){8,30}+$/', $this->field($index)))
      $this->_errors[$index] = $errMsg;

    return $this;
  }

  // Saisis possibles pour mots de passes
  public function isNotPossiblePW(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^([-.âäàéèùêëîïôöçñÂÄÀÉÈÙÊËÎÏÔÖÇÑ!?"%,;:()=&œ@$*^+¨°#{}\/\w]{1,}){8,30}+$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

// validité d'adresse E-mail
  public function isNotValidEmail(): self
  {
    [$index, $errMsg] = func_get_args();

    if (!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,6}$/', $this->field($index)))
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  public function in(): self
  {
    [$tableName] = func_get_args();
    $this->_tableName = $tableName;
    return $this;
  }

  public function isInTable(?string $message = null): self
  {
    $index = explode(",", $this->_whereClose);
    $result = AppController::sqlFetch("SELECT $this->_entree FROM $this->_tableName WHERE $this->_whereClose", $this->_listValues, $this->_db);
    if ($result)
        $this->_errors[$index[0]] = is_null($message)?$this->_errMessage:$message;

    return $this;
  }

  public function isNotInTable(?string $message = null): self
  {
    $index = explode(",", $this->_whereClose);
    $result = AppController::sqlFetch("SELECT $this->_entree FROM $this->_tableName WHERE $this->_whereClose", $this->_listValues, $this->_db);
    if (!$result)
        $this->_errors[$index[0]] = $message ?? $this->_errMessage;

    return $this;
  }

  public function isNotExisted(string $index, string $col, string $table, $errMsg): self
  {
    $result = parent::customQuery("SELECT id FROM $table WHERE $col=:champ", ['champ'=>$this->field($index)]);
    if (!$result)
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  public function alreadyCreated(string $index, string $table, int $uid, $errMsg): self
  {
    $result = parent::customQuery(
      "SELECT id FROM $table WHERE $index=:champ AND $uid=:uid",
          ['champ'=>$this->field($index), 'uid'=> $uid]);
    if ($result)
    {
      $this->_errors[$index] = $errMsg;
    }

    return $this;
  }

  public function Max_Length_Chars(string $index, int $limit, $errMsg): self
  {
    if (strlen($this->field($index)) > $limit)
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  public static function limitCaract($value, $limit = 100, $end = '...')
  {
      if (mb_strwidth($value, 'UTF-8') <= $limit)
          return $value;

      return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
  }

  public function dataVerify(string $index, string $tbl, string $col, $errMsg): self
  {
    $result = parent::customQuery("SELECT id FROM $tbl WHERE $col = :champ", ['champ'=>$this->field($index)]);
    if (!$result)
        $this->_errors[$index] = $errMsg;

    return $this;
  }

  public function isConfirmed(): self
  {
    [$index, $errMsg] = func_get_args();

    $value = $this->field($index);
    if(empty($value) || $value != $this->field($index . '_confirm'))
      $this->_errors[$index] = $errMsg;

    return $this;
  }

  public function isValidated()
  {
    return empty($this->_errors);
  }

  public function getErrors()
  {
    return $this->_errors;
  }

  public function displayWithListItem(string $listType = "ul", string $cssClassName = "alert-danger", string $listStyleType = "disclosure-closed")
  {
    $output = NULL;

    if (!empty($this->getErrors()))  {
      $output = '<div class="'.$cssClassName.'">  <'. $listType .'>';
        foreach ($this->getErrors() as $err)      {
          $output .= '<li style="list-style-type:' . $listStyleType . '">' . $err . '</li>';
        }
      $output .= '</'. $listType .'>  </div>';
    }

    echo $output;
    exit;
  }

}
