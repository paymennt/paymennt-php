<?php namespace Paymennt\checkout;

require_once(__DIR__.'/AbstractCheckoutRequest.php');
use Paymennt\Exception as Exception;

/**
*  Checkout class
*
*  A refund checkout request class
*
*  @author abdullah
*/
class RefundCheckoutRequest extends AbstractCheckoutRequest {

  /**
  * The checkoutId for which refund has to be initiated
  * @var string
  */
  public $checkoutId;
  
  /**
  * Reason/note for the refund
  * @var string
  */
  public $note;


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
    // amount validation
    if (!isset($this->amount)|| empty($this->amount)) {
      throw new Exception("amount cannot be null or empty");
    }
    // amount validation
    if (isset($this->amount)) {
      $this->validateAmount("amount");
    }
    // currency validation
    if (!isset($this->currency) || empty($this->currency)) {
      throw new Exception("currency cannot be empty or empty");
    }

    // currency validation
    if (isset($this->currency)) {
      $this->validateCurrencyCode("currency");
    }

    // note validation
    if (!isset($this->note) || empty($this->note)) {
      throw new Exception("note cannot be null or empty");
    }

    return true;
  }

}
