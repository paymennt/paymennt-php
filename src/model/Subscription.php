<?php namespace Paymennt\model;

/**
*  Subscription class
*
*  A subscription class representing a PAYMENNT Subscription object
*
*  @author abdullah
*/
class Subscription {
  /**
  * subscription id identifying the subscription on the PAYMENNT platform
  * @var string
  */
  public $id;

  /**
  * displayId for the subscription 
  * @var string
  */
  public $displayId;

  /**
  * description of the subscription
  * @var string
  */
  public $description;

  /**
  * the currency of this subscription
  * @var string
  */
  public $currency;

  /**
  * the amount of this subscription
  * @var string
  */
  public $amount;

  /**
  * status of this subscription. can be one of:
  *   ACTIVE, INACTIVE, ARCHIVED, EXPIRED 
  * @var string
  */
  public $status;

  /**
  * customer associated with this subcription
  * @var Customer
  */
  public $customer;

  /**
  * start date of the subscription in format (yyyy-MM-dd).
  * @var string
  */
  public $startDate;
  /**
  * end date of the subscription in format (yyyy-MM-dd).
  * @var string
  */
  public $endDate;

  /**
  * hour of day in UTC the checkout will be created on
  * @var int
  */
  public $sendOnHour;

  /**
  * Enum: "DAY" "WEEK" "TWO_WEEKS" "MONTH" "TWO_MONTHS" "THREE_MONTHS" "SIX_MONTHS" "YEAR"
  * When to create the checkout
  * @var string
  */
  public $sendEvery;

  /**
  * 
  * @var int
  */
  public $period;

  /**
  * 
  * @var string
  */
  public $periodUnit;

  /**
  * URL to redirect user to after a successful or failed payment.(Optional)
  * @var string
  */
  public $returnUrl;

  /**
  * subscription payment chekout object
  * @var checkout
  */
  public $checkout;

  /**
  * timestamp
  * @var string
  */
  public $timestamp;

  /**
  * cancelled flag for the subscription checkout
  * @var bool
  */
  public $cancelled;

}