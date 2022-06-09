<?php namespace Paymennt\model;

/**
*  Payment class
*
*  A payment class representing a PAYMENNT payment object
*
*  @author abdullah khan
*/
class Payment {
  /**
  * payment id identifying this checkout on the PAYMENNT platform
  * @var string
  */
  public $id;

  /**
  * the amount of this payment
  * @var string
  */
  public $amount;
  
  /**
  * the currency of this payment
  * @var string
  */
  public $currency;

  /**
  * status of this checkout. can be one of:
  *   REDIRECT: redirected to 3D secure page
  *   VOIDED: expired without a successful payment
  *   FAILED: not paid due to failed payment attempt
  *   REJECTED: expired without a successful payment
  *   REVERSED: the full paid amount was reversed
  *   PARTIALLY_REVERSED: part of the paid amount was reversed
  *   AUTHORIZED: the transaction was successfully authorized but funds are not captured yet
  *   CAPTURED: the transaction was successfully captured
  * @var string
  */
  public $status;

  /**
  * redirect url of the payment page
  * @var string
  */
  public $redirectUrl;

  /**
  * timestamp
  * @var string
  */
  public $timestamp;

  /**
  * checkout attached to the payment
  * @var Checkout
  */
  public $checkoutDetails;

  /**
  * in case of error, will have a message string
  * @var string
  */
  public $responseMessage;

}