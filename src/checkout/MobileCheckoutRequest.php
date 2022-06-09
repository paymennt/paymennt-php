<?php namespace Paymennt\checkout;

require_once(__DIR__.'/AbstractCheckoutRequest.php');
use Paymennt\Exception as Exception;

/**
*  Checkout class
*
*  A web checkout request class
*
*  @author bashar
*/
class MobileCheckoutRequest extends AbstractCheckoutRequest {

  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    // parent validation
    parent::validate();

    // customer validation
    if (!isset($this->customer)) {
      throw new Exception("customer cannot be null");
    }
    if (empty($this->customer->email)) {
      throw new Exception("customer email cannot be null or empty");
    }

    // billing address validation
    if (!isset($this->billingAddress)) {
      throw new Exception("billing address cannot be null");
    }

    // line item validation
    if (!isset($this->items) || empty($this->items)) {
      throw new Exception("items cannot be empty");
    }

    
    return true;
  }

}
