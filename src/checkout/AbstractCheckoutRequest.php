<?php namespace Paymennt\checkout;

require_once(__DIR__.'/../Validatable.php');
use Paymennt\Exception as Exception;

/**
*  Checkout class
*
*  A checkout class representing a PAYMENNT checkout object
*
*  @author bashar
*/

abstract class AbstractCheckoutRequest extends \Paymennt\Validatable {

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
  * order totals associated with this checkout
  * @var Totals
  */
  public $totals;

  /**
  * id of the branch to which this payment belongs
  * @var string
  */
  public $branchId;

  /**
  * name of the branch to which this payment belongs
  * @var Array
  */
  public $allowedPaymentMethods;

  /**
  * The method used to complete the payment
  * @var string
  */
  public $defaultPaymentMethod;

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
  * Array of line items to pass to the checkout
  * @var Array
  */
  public $items;

  /**
  * default language to use for the checkout form
  * @var string
  */
  public $language = "en";

  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    $this->validateNullEmpty("requestId");
    $this->validateNullEmpty("orderId");
    $this->validateAmount("amount");
    if (preg_match('/^[a-zA-Z]{3}$/', $this->currency) !== 1) {
      throw new Exception("currency code must be a 3-digit ISO code and non empty.");
    }
    if (isset($this->totals)) $this->totals->validate();
    if (isset($this->customer)) $this->customer->validate();
    if (isset($this->billingAddress)) $this->billingAddress->validate();
    if (isset($this->deliveryAddress)) $this->deliveryAddress->validate();
    if (!empty($this->items)) {
      foreach ($this->items as $item) {
        $item->validate();
      }
    }

  }

}
