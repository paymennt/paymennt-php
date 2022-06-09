<?php namespace Paymennt\subscription;

require_once(__DIR__.'/AbstractSubscriptionRequest.php');
use Paymennt\Exception as Exception;

/**
*  Subscription class
*
*  new subscription creation request class
*
*  @author abdullah
*/

class CreateSubscriptionRequest extends AbstractSubscriptionRequest {


  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {

    // description validation
    if (!isset($this->description)|| empty($this->description)) {
      throw new Exception("description cannot be null or empty");
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
    // customer validation
    if (!isset($this->customer)) {
      throw new Exception("customer cannot be null");
    }
    if (empty($this->customer->email)) {
      throw new Exception("customer email cannot be null or empty");
    }
    // customer validation is its set
    if (isset($this->customer)) {
      $this->customer->validate();
    } 
    // startDate validation
    if (!isset($this->startDate)|| empty($this->startDate)) {
      throw new Exception("startDate cannot be null or empty");
    } 
    // sendOnHour validation
    if (!isset($this->sendOnHour)|| empty($this->sendOnHour)) {
      throw new Exception("sendOnHour cannot be null or empty");
    } 
    // sendOnHour validation
    if (isset($this->sendOnHour)) {
      if((int)$this->sendOnHour<0 && (int)$this->sendOnHour>23){
        throw new Exception("sendOnHour must be between 0 and 23");
      }
    } 
    // sendEvery validation
    if (!isset($this->sendEvery)|| empty($this->sendEvery)) {
      throw new Exception("sendEvery cannot be null or empty");
    } 
    
    return true;
  }

}
