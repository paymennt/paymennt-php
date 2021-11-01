<?php namespace Paymennt;

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
  private $id;

  /**
  * a short display id for the checkout id
  * @var string
  */
  private $displayId;

  /**
  * the checkout key used to identify the checkout in device payments
  * @var string
  */
  private $checkoutKey;

  /**
  * the payment request ID for which this checkout was created. unique per order id per merchant.
  * @var string
  */
  private $requestId;

  /**
  * merchant order id for which this checkout was created. an order can have multiple requests.
  * @var string
  */
  private $orderId;

  /**
  * the currency of this checkout
  * @var string
  */
  private $currency;

  /**
  * the amount of this checkout
  * @var string
  */
  private $amount;

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
  private $status;

  /**
  * redirect url of the payment page
  * @var string
  */
  private $redirectUrl;

  /**
  * id of the branch to which this payment belongs
  * @var string
  */
  private $branchId;

  /**
  * name of the branch to which this payment belongs
  * @var string
  */
  private $branchName;

  /**
  * The method used to complete the payment
  * @var string
  */
  private $usedPaymentMethod;

  /**
  * merchant customer associated with this checkout
  * @var Customer
  */
  private $customer;

  /**
  * billing address associated with checkout customer
  * @var Address
  */
  private $billingAddress;

  /**
  * delivery address associated with checkout customer
  * @var Address
  */
  private $deliveryAddress;

  /**
  * Optional: Base 64 encoded payment QR code
  * @var string
  */
  private $base64QR;

  /**
  * Optional: id of subscription that this checkout belongs to
  * @var string
  */
  private $subscriptionId;

  /*************************************************************************************************
  * GETTERS AND SETTERS
  */

  /**
  * Get the value of checkout id identifying this checkout on the PAYMENNT platform
  * @return string
  */
  public function getId() {
    return $this->id;
  }

  /**
  * Set the value of checkout id identifying this checkout on the PAYMENNT platform
  * @param string $id
  * @return self
  */
  public function setId(string $id) {
    $this->id = $id;
    return $this;
  }

  /**
  * Get the value of a short display id for the checkout id
  * @return string
  */
  public function getDisplayId() {
    return $this->displayId;
  }

  /**
  * Set the value of a short display id for the checkout id
  * @param string $displayId
  * @return self
  */
  public function setDisplayId(string $displayId) {
    $this->displayId = $displayId;
    return $this;
  }

  /**
  * Get the value of the checkout key used to identify the checkout in device payments
  * @return string
  */
  public function getCheckoutKey() {
    return $this->checkoutKey;
  }

  /**
  * Set the value of the checkout key used to identify the checkout in device payments
  * @param string $checkoutKey
  * @return self
  */
  public function setCheckoutKey(string $checkoutKey) {
    $this->checkoutKey = $checkoutKey;
    return $this;
  }

  /**
  * Get the value of the payment request ID for which this checkout was created. unique per order id per merchant.
  * @return string
  */
  public function getRequestId() {
    return $this->requestId;
  }

  /**
  * Set the value of the payment request ID for which this checkout was created. unique per order id per merchant.
  * @param string $requestId
  * @return self
  */
  public function setRequestId(string $requestId) {
    $this->requestId = $requestId;
    return $this;
  }

  /**
  * Get the value of merchant order id for which this checkout was created. an order can have multiple requests.
  * @return string
  */
  public function getOrderId() {
    return $this->orderId;
  }

  /**
  * Set the value of merchant order id for which this checkout was created. an order can have multiple requests.
  * @param string $orderId
  * @return self
  */
  public function setOrderId(?string $orderId) {
    $this->orderId = $orderId;
    return $this;
  }

  /**
  * Get the value of the currency of this checkout
  * @return string
  */
  public function getCurrency() {
    return $this->currency;
  }

  /**
  * Set the value of the currency of this checkout
  * @param string $currency
  * @return self
  */
  public function setCurrency(string $currency) {
    $this->currency = $currency;
    return $this;
  }

  /**
  * Get the value of the amount of this checkout
  * @return string
  */
  public function getAmount() {
    return $this->amount;
  }

  /**
  * Set the value of the amount of this checkout
  * @param string $amount
  * @return self
  */
  public function setAmount(string $amount) {
    $this->amount = $amount;
    return $this;
  }

  /**
  * Get the value of status of this checkout. can be one of:
  * @return string
  */
  public function getStatus() {
    return $this->status;
  }

  /**
  * Set the value of status of this checkout. can be one of:
  * @param string $status
  * @return self
  */
  public function setStatus(string $status) {
    $this->status = $status;
    return $this;
  }

  /**
  * Get the value of redirect url of the payment page
  * @return string
  */
  public function getRedirectUrl() {
    return $this->redirectUrl;
  }

  /**
  * Set the value of redirect url of the payment page
  * @param string $redirectUrl
  * @return self
  */
  public function setRedirectUrl(string $redirectUrl) {
    $this->redirectUrl = $redirectUrl;
    return $this;
  }

  /**
  * Get the value of id of the branch to which this payment belongs
  * @return string
  */
  public function getBranchId() {
    return $this->branchId;
  }

  /**
  * Set the value of id of the branch to which this payment belongs
  * @param string $branchId
  * @return self
  */
  public function setBranchId(?string $branchId) {
    $this->branchId = $branchId;
    return $this;
  }

  /**
  * Get the name of the branch to which this payment belongs
  * @return string
  */
  public function getBranchName() {
    return $this->branchname;
  }

  /**
  * Set the name of the branch to which this payment belongs
  * @param string $branchName
  * @return self
  */
  public function setBranchName(?string $branchName) {
    $this->branchName = $branchName;
    return $this;
  }

  /**
  * Get the value of The method used to complete the payment
  * @return string
  */
  public function getUsedPaymentMethod() {
    return $this->usedPaymentMethod;
  }

  /**
  * Set the value of The method used to complete the payment
  * @param string $usedPaymentMethod
  * @return self
  */
  public function setUsedPaymentMethod(?string $usedPaymentMethod) {
    $this->usedPaymentMethod = $usedPaymentMethod;
    return $this;
  }

  /**
  * Get the value of merchant customer associated with this checkout
  * @return Customer
  */
  public function getCustomer() {
    return $this->customer;
  }

  /**
  * Set the value of merchant customer associated with this checkout
  * @param Customer $customer
  * @return self
  */
  public function setCustomer(Customer $customer) {
    $this->customer = $customer;
    return $this;
  }

  /**
  * Get the value of billing address associated with checkout customer
  * @return Address
  */
  public function getBillingAddress() {
    return $this->billingAddress;
  }

  /**
  * Set the value of billing address associated with checkout customer
  * @param Address $billingAddress
  * @return self
  */
  public function setBillingAddress(Address $billingAddress) {
    $this->billingAddress = $billingAddress;
    return $this;
  }

  /**
  * Get the value of delivery address associated with checkout customer
  * @return Address
  */
  public function getDeliveryAddress() {
    return $this->deliveryAddress;
  }

  /**
  * Set the value of delivery address associated with checkout customer
  * @param Address $deliveryAddress
  * @return self
  */
  public function setDeliveryAddress(Address $deliveryAddress) {
    $this->deliveryAddress = $deliveryAddress;
    return $this;
  }

  /**
  * Get the value of Base 64 encoded payment QR code
  * @return string
  */
  public function getBase64QR() {
    return $this->base64QR;
  }

  /**
  * Set the value of Base 64 encoded payment QR code
  * @param string $base64QR
  * @return self
  */
  public function setBase64QR(?string $base64QR) {
    $this->base64QR = $base64QR;
    return $this;
  }

  /**
  * Get the value of subscription id for which this checkout was created
  * @return string
  */
  public function getSubscriptionId() {
    return $this->subscriptionId;
  }

  /**
  * Set the value of subscription id for which this checkout was created
  * @param string $subscriptionId
  * @return self
  */
  public function setSubscriptionId(?string $subscriptionId) {
    $this->subscriptionId = $subscriptionId;
    return $this;
  }


}
