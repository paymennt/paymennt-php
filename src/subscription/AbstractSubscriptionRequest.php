<?php namespace Paymennt\subscription;

require_once(__DIR__.'/../Validatable.php');

/**
*  Subscription class
*
*  A subscription class representing a PAYMENNT subscription object
*
*  @author abdullah
*/
abstract class AbstractSubscriptionRequest extends \Paymennt\Validatable {

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
  * customer associated with this subcription
  * @var Customer
  */
  public $customer;

  /**
  * customerId associated with this subcription
  * @var string
  */
  public $customerId;
 
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
  * URL to redirect user to after a successful or failed payment.(Optional)
  * @var string
  */
  public $returnUrl;
  

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
