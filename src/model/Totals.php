<?php namespace Paymennt\model;

require_once(__DIR__.'/../Validatable.php');

/**
* LineItem class
*
* Class representing a purchase / invoice line item
*
* @author bashar
*/
class Totals extends \Paymennt\Validatable {
  /**
  * subtotal
  * @var string
  */
  public $subtotal = 0;

  /**
  * tax
  * @var string
  */
  public $tax = 0;

  /**
  * shipping
  * @var string
  */
  public $shipping = 0;

  /**
  * handling
  * @var string
  */
  public $handling = 0;

  /**
  * shipping
  * @var string
  */
  public $discount = 0;


  /**
  * shipping
  * @var bool
  */
  public $skipTotalsValidation  = true;

  /*************************************************************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    $this->validateAmount("subtotal");
    $this->validateAmount("tax");
    $this->validateAmount("shipping");
    $this->validateAmount("discount");
    $this->validateAmount("handling");
  }
}