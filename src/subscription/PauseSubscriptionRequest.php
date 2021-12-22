<?php namespace Paymennt\subscription;

require_once(__DIR__.'/AbstractSubscriptionRequest.php');
use Paymennt\Exception as Exception;

/**
*  Subscription class
*
*  pause subscription by subscriptionId request class
*
*  @author abdullah
*/

class PauseSubscriptionRequest extends AbstractSubscriptionRequest {


  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  
  public function validate() {
   
    // subscriptionId validation
    if (!isset($this->subscriptionId)|| empty($this->subscriptionId)) {
      throw new Exception("subscriptionId cannot be null or empty");
    }

    return true;
  }

}
