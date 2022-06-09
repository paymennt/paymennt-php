<?php namespace Paymennt\webhooks;

require_once(__DIR__.'/AbstractWebhookRequest.php');
use Paymennt\Exception as Exception;

/**
*  Webhook class
*
*  new webhook creation request class
*
*  @author abdullah
*/ 

class CreateWebhookRequest extends AbstractWebhookRequest {


  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  
  public function validate() {

    // address validation
    if (!isset($this->address)|| empty($this->address)) {
      throw new Exception("address cannot be null or empty");
    }
    return true;
  }
}
