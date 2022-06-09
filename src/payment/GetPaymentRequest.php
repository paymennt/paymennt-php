<?php namespace Paymennt\payment;

use Paymennt\Exception as Exception;

/**
*  Payment class
*
*  A request class intend to fetch payment by ID
*
*  @author abdullah
*/

class GetPaymentRequest {

  /**
  * The paymentId of payment to be fetched
  * @var string
  */
  public $paymentId;

  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    // paymentId validation
    if (!isset($this->paymentId)|| empty($this->paymentId)) {
      throw new Exception("paymentId cannot be null or empty");
    }
    return true;
  }
}