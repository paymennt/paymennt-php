<?php namespace Paymennt\webhooks;

require_once(__DIR__.'/AbstractWebhookRequest.php');
use Paymennt\Exception as Exception;

/**
*  Webhook class
*
*  enable webhook by webhookId request class
*
*  @author abdullah
*/

class EnableWebhookRequest extends AbstractWebhookRequest {


  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
   
    // webhookId validation
    if (!isset($this->webhookId)|| empty($this->webhookId)) {
      throw new Exception("webhookId cannot be null or empty");
    }
    return true;
  }
}
