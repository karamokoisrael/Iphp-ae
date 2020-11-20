<?php
namespace Controller\Featured;

/**
 *
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};
use Controller\Controller\{AppController};

class Mailer extends PHPMailer
{

  protected $_exceptions;
  protected $_address;
  protected $_addressName;
  protected $_from;
  protected $_fromName;
  protected $_subject;
  protected $_contents;
  protected $_errorInfos = null;

  function __construct()
  {

    $data = AppController::iphpConfig(
      "mail.from"
    );
    $this->_from = $data["address"];
    $this->_fromName = $data["name"];

    parent::__construct();

    $this->SMTPDebug = SMTP::DEBUG_OFF;
    $this->Mailer = self::Mailer(

    );
    $this->setFrom(
      $this->_from, $this->_fromName
    );
    $this->Host = self::Hosting();
    $this->SMTPAuth   = self::Authentification();
    $this->Username   = self::login();
    $this->Password   = self::pass();

    $this->isHTML(true);

    $this->_errorInfos = $this->ErrorInfo;
  }

  public function from(
    $address = "", $name = ""
    ): self
  {
    $data = AppController::iphpConfig(
      "mail.from"
    );
    $this->_from = !empty(
      $address
      )?$address:$data[
        "address"
      ];
    $this->_fromName = !empty(
      $name
      )?$name:$data[
        "name"
      ];
    return $this;
  }

  // public function from($address, $name = ""): self
  // {
  //
  //   $this->_from = $address;
  //   $this->_fromName = $name;
  //   $this->setFrom($address, $name);
  //   return $this;
  // }

  public function to($address, $name = ""): self
  {

    $this->_address = $address;
    $this->_addressName = $name;
    $this->addAddress(
      $address, $name
    );
    return $this;
  }

  public function subject($subject): self
  {

    $this->_subject = $subject;
    $this->Subject = $subject;
    return $this;
  }

  public function mailContent($content, $file = ""): self
  {

    $real_c = $content;
    $content = (
      $file !== "template"
      ) ?
    $content = $content :
    $content = true;

    if ($content === true) {
      if (file_exists('../../' . EmailingTemplates . IPHP_DS . $real_c))
          file_get_contents(
            '../../' . EmailingTemplates . IPHP_DS . $real_c
          );
      IphpThrowError(
        "errcd21219", $real_c.'.html', EmailingTemplates . IPHP_DS . $real_c.'.html'
      );
    }

    $this->_contents = $content;
    $this->msgHTML(
      $content
    );
    return $this;
  }

  public function replyTo($address, $name = null): self
  {

    $this->addReplyTo(
      $address, $name
    );
    return $this;
  }

  public function CC(
    $address, $name = null
    ): self
  {

    $this->addCC(
      $address, $name
    );
    return $this;
  }

  public function BCC(
    $address, $name = null
    ): self
  {

    $this->addBCC(
      $address, $name
    );
    return $this;
  }

  public function attachment(
    string $file
    ): self
  {

    $this->addAttachment(
      $file
    );
    return $this;
  }

  private function Mailer()
  {
    $mailer = AppController::iphpConfig(
      "mail.default"
    );

    $list = [
      "smtp", "mail", "sendmail", "qmail"
    ];

    if (!in_array($mailer, $list))
        IphpThrowError(
          "errcd21214", $mailer
        );

    return $mailer;
  }

  private function Hosting()
  {

    $data = AppController::iphpConfig(
      "mail.mailers"
    );
    $mailer = self::Mailer();
    $data = $data[$mailer];
    return $data["SMTPSecure"]."://".$data[
      "host"
      ].":".$data[
        "port"
      ];
  }

  private function Authentification()
  {

    $data = AppController::iphpConfig("mail.mailers");
    $mailer = self::Mailer();
    return $data[
      $mailer
      ][
        "SMTPAuth"
      ];
  }

  public function debugServer():self
  {
    $this->SMTPDebug = SMTP::DEBUG_SERVER;
    return $this;
  }

  private function login()
  {

    $data = AppController::iphpConfig(
      "mail.mailers"
    );

    $mailer = self::Mailer(
    );

    return $data[
      $mailer
      ][
        "username"
      ];
  }

  private function pass()
  {

    $data = AppController::iphpConfig(
      "mail.mailers"
    );
    $mailer = self::Mailer(
    );
    return $data[
      $mailer
      ][
        "password"
      ];
  }

  public function errorInfos()
  {

    return $this->_errorInfos;
  }

  public function debugOutput():self
  {
    $this->Debugoutput = static function (
      $str, $level
    ) {
        echo "Debug level $level; message: $str\n";
    };
    return $this;
  }

  /**
   * debuger method (for developpement process)
   */
  public static function debug($params)
  {
    echo "<pre>";
    echo var_dump($params, true);
    echo "</pre>";
  }
}
