<?php namespace Paymennt\model;

require_once(__DIR__.'/../Validatable.php');

/**
* LineItem class
*
* Class representing a purchase / invoice line item
*
* @author bashar
*/
class Item extends \Paymennt\Validatable {
  /**
  * name of item
  * @var string
  */
  public $name;

  /**
  * ske
  * @var string
  */
  public $sku;

  /**
  * item price
  * @var string
  */
  public $unitprice;

  /**
  * item quantity
  * @var string
  */
  public $quantity;

  /**
  * line total
  * @var string
  */
  public $linetotal;

  /*************************************************************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    $this->validateNullEmpty("name");
    $this->validateNumber("quantity");
    $this->validateAmount("linetotal");
    if (isset($this->unitprice)) {
      $this->validateAmount("unitprice");
    }
  }
}