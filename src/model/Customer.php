<?php namespace Paymennt\model;

require_once(__DIR__.'/../Validatable.php');

/**
*  Customer class
*
*  Class representing a customer
*
*  @author bashar
*/
class Customer extends \Paymennt\Validatable {

  private const REGEX_EMAIL = "/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/";

  /**
  * customer identifier in the PAYMENNT platform
  * @var string
  */
  public $id;

  /**
  * customer identifier in the merchant system
  * @var string
  */
  public $reference;

  /**
  * customer first name
  * @var string
  */
  public $firstName;

  /**
  * customer last name
  * @var string
  */
  public $lastName;

  /**
  * Customer email address
  * @var string
  */
  public $email;

  /**
  * customer phone number with international calling code (Ex. 971567xxxxxx)
  * @var string
  */
  public $phone;

  /*************************************************************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    $this->validateNullEmpty("firstName");
    $this->validateNullEmpty("lastName");
    if (!empty($this->email)) {
      $this->validateEmail("email");
    }
  }
}