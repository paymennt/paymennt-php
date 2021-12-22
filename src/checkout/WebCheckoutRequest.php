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
class WebCheckoutRequest extends AbstractCheckoutRequest {

  /**
  * The return URl where the user is to return after payment
  * @var string
  */
  public $returnUrl;


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
    $this->customer->validate();

    // billing address validation
    if (!isset($this->billingAddress)) {
      throw new Exception("billing address cannot be null");
    }

    // line item validation
    if (!isset($this->items) || empty($this->items)) {
      throw new Exception("items cannot be empty");
    }

    if (filter_var($this->returnUrl, FILTER_VALIDATE_URL) === FALSE) {
      throw new Exception("returnUrl must be a valid url including protocol: '" . $this->returnUrl . "'");
    }
    return true;
  }

}
