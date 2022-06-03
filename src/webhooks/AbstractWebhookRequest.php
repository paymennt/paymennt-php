<?php namespace Paymennt\webhooks;

require_once(__DIR__.'/../Validatable.php');
use Paymennt\Exception as Exception;

/**
*  Webhook class
*
*  A Webhook class representing a PAYMENNT webhook object
*
*  @author abdullah
*/
abstract class AbstractWebhookRequest extends \Paymennt\Validatable {

  /**
  * webhook id identifying this webhook on the PAYMENNT platform
  * @var string
  */
  public $webhookId;

  /**
  * webhook endpoint that Paymennt server will push messages to.

  * @var string
  */
  public $adress;


  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    return true;
  }

}