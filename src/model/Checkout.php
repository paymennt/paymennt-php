<?php namespace Paymennt\model;

/**
*  Checkout class
*
*  A checkout class representing a PAYMENNT checkout object
*
*  @author bashar
*/
class Checkout {
  /**
  * checkout id identifying this checkout on the PAYMENNT platform
  * @var string
  */
  public $id;

  /**
  * a short display id for the checkout id
  * @var string
  */
  public $displayId;

  /**
  * the checkout key used to identify the checkout in device payments
  * @var string
  */
  public $checkoutKey;

  /**
  * the payment request ID for which this checkout was created. unique per order id per merchant.
  * @var string
  */
  public $requestId;

  /**
  * merchant order id for which this checkout was created. an order can have multiple requests.
  * @var string
  */
  public $orderId;

  /**
  * the currency of this checkout
  * @var string
  */
  public $currency;

  /**
  * the amount of this checkout
  * @var string
  */
  public $amount;

  /**
  * the cashAmount of this checkout
  * @var string
  */
  public $cashAmount;

  /**
  * status of this checkout. can be one of:
  *   PENDING: not paid
  *   AUTHORIZED: the transaction was successfully authorized but funds are not captured yet
  *   PAID: successfully paid
  *   FAILED: not paid due to multiple failed payment attemptes
  *   CANCELLED: cancelled by user
  *   EXPIRED: expired without a successful payment
  *   REFUNDED: the full paid amount was refunded
  *   PARTIALLY_REFUNDED: part of the paid amount was refunded
  * @var string
  */
  public $status;

  /**
  * the totalRefunded of this checkout
  * @var string
  */
  public $totalRefunded;

  /**
  * redirect url of the payment page
  * @var string
  */
  public $redirectUrl;

  /**
  * The method used to complete the payment
  * @var string
  */
  public $usedPaymentMethod;

  /**
  * merchant customer associated with this checkout
  * @var Customer
  */
  public $customer;

  /**
  * billing address associated with checkout customer
  * @var Address
  */
  public $billingAddress;

  /**
  * delivery address associated with checkout customer
  * @var Address
  */
  public $deliveryAddress;

  /**
  * timestamp
  * @var string
  */
  public $timestamp;

  /**
  * Optional: Base 64 encoded payment QR code
  * @var string
  */
  public $base64QR;

  /**
  * Optional: id of subscription that this checkout belongs to
  * @var string
  */
  public $subscriptionId;

   /**
  * id of the branch to which this payment belongs
  * @var string
  */
  public $branchId;

  /**
  * name of the branch to which this payment belongs
  * @var string
  */
  public $branchName;


}