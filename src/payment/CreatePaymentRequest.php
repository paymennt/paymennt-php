<?php namespace Paymennt\payment;

use Paymennt\Exception as Exception;
use \Paymennt\model\TokenPaymentSource as TokenPaymentSource;

/**
*  Payment class
*
*  A token payment creation request class
*
*  @author abdullah khan
*/
class CreatePaymentRequest {

  /**
  * source object
  * @var TokenPaymentSource
  */

  public TokenPaymentSource $source;
  
  /**
  * checkoutId (optional)
  * @var string
  */
  public $checkoutId;

  /**
  * checkoutDetails
  * @var WebCheckoutRequest
  */
  public $checkoutDetails;

  /*************************************************
  * CLASS METHODS
  */

   /**
  * constructor that takes the checkoutDetails and token and crates the CreatePayemntRequest object from it.
  */
  public function __construct($type, $token, $checkoutId, $checkoutDetails) {
    $this->source = new TokenPaymentSource();
    $this->source->type = $type;
    $this->source->token = $token;
    $this->checkoutId = $checkoutId;
    $this->checkoutDetails = $checkoutDetails;
  }

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    //  validation of the class member objects
    $function_name ="validate";

    $this->source->validate();
    $this->checkoutDetails->validate();
    
    return true;
  }

}