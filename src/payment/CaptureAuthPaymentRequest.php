<?php namespace Paymennt\payment;

use Paymennt\Exception as Exception;

/**
*  Payment class
*
*  A request class to cature an authorized payment
*
*  @author abdullah
*/
class CaptureAuthPaymentRequest {

  /**
  * The paymentId of payment to be captured
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