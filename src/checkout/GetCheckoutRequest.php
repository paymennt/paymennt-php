<?php namespace Paymennt\checkout;

require_once(__DIR__.'/AbstractCheckoutRequest.php');
use Paymennt\Exception as Exception;

/**
*  Checkout class
*
*  A web checkout request class
*
*  @author abdullah
*/

class GetCheckoutRequest extends AbstractCheckoutRequest {

  /**
  * The checkoutId of checkout to be fetched
  * @var string
  */
  public $checkoutId;

  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    // checkoutId validation
    if (!isset($this->checkoutId)|| empty($this->checkoutId)) {
      throw new Exception("checkoutId cannot be null or empty");
    }
    return true;
  }
}
