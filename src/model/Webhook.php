<?php namespace Paymennt\model;

/**
*  Webhook class
*
*  A Webhook class representing a PAYMENNT Webhook object
*
*  @author abdullah
*/
class Webhook {
  /**
  * webhook id identifying the webhook on the PAYMENNT platform
  * @var string
  */
  public $id;

  /**
  * hmac key for the webhook 
  * @var string
  */
  public $hmacKey;

  /**
  * the address of the webhook
  * @var string
  */
  public $address;

  /**
  * failed flag of the webhook
  * @var string
  */
  public $failed;

  /**
  * enabled flag for the webhook
  * @var string
  */
  public $enabled;

}