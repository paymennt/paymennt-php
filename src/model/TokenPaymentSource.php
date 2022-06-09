<?php namespace Paymennt\model;

require_once(__DIR__.'/../Validatable.php');

/**
* TokenPaymentSource class
*
* Class representing source of token and its value 
*
* @author abdullah khan
*/
class TokenPaymentSource extends \Paymennt\Validatable {
  /**
  * source type eg: "TOKEN"
  * @var string
  */
  public $type;

  /**
  * token value
  * @var string
  */
  public $token;

  /*************************************************************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    $this->validateNullEmpty("type");
    $this->validateNullEmpty("token");
  }
}