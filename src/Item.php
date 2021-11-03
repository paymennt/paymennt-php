<?php namespace Paymennt;

/**
* LineItem class
*
* Class representing a purchase / invoice line item
*
* @author bashar
*/
class Item extends Validatable {
  /**
  * name on address
  * @var string
  */
  public $name;

  /**
  * address line 1
  * @var string
  */
  public $sku;

  /**
  * address line 2
  * @var string
  */
  public $unitprice;

  /**
  * address city
  * @var string
  */
  public $quantity;

  /**
  * address state
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
