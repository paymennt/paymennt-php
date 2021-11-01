<?php namespace Paymennt;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author bashar
*/
final class PaymenntClient {

  private const ENV_URL_LIVE  = "https://api.pointcheckout.com/mer/v2.0/";
  private const ENV_URL_TEST  = "https://api.test.pointcheckout.com/mer/v2.0/";
  private const URL_CHECKOUT = "checkout/";

  /**  @var string $apiKey the PAYMENNT API Key */
  private string $apiKey = '';

  /**  @var string $apiSecret the PAYMENNT API Secret */
  private string $apiSecret = '';

  /**  @var string $useTestEnvironment Whether or not to use the test environment */
  private bool $useTestEnvironment = false;

  public function __construct(string $apiKey, string $apiSecret) {
    if (empty($apiKey) || empty($apiSecret))
    throw new Exception('apiKey and/or apiSecret cannot be null');
    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
  }

  /**
  * useTestEnvironment(): Whether to use Test Environment for this client
  * @param bool $useTestEnvironment A bool indicating whether or not to use the test environment
  */
  public function useTestEnvironment(bool $useTestEnvironment) : PaymenntClient {
    $this->useTestEnvironment = $useTestEnvironment;
    return $this;
  }

  /***********************************************************************************************
  * CHECKOUT API CALLS
  */

  public function getCheckout(string $checkoutId) : Checkout {
    $url = PaymenntClient::URL_CHECKOUT . $checkoutId;
    $result = $this->apiCall($url, null);
    $checkout = new Checkout();
    $checkout->setId($result->id);
    $checkout->setDisplayId($result->displayId);
    $checkout->setCheckoutKey($result->checkoutKey);
    $checkout->setRequestId($result->requestId);
    $checkout->setOrderId($result->orderId);
    $checkout->setCurrency($result->currency);
    $checkout->setAmount($result->amount);
    $checkout->setStatus($result->status);
    $checkout->setRedirectUrl($result->redirectUrl);
    $checkout->setBranchId($result->branchId);
    $checkout->setBranchName($result->branchName);
    $checkout->setUsedPaymentMethod($result->usedPaymentMethod);

    # values not present in every API call
    if (isset($result->base64QR)) {
      $checkout->setBase64QR($result->base64QR);
    }
    if (isset($result->subscriptionId)) {
      $checkout->setSubscriptionId($result->subscriptionId);
    }

    if (isset($result->customer)) {
      $resultCustomer = $result->customer;
      $customer = new Customer();
      $customer->setId($resultCustomer->id);
      $customer->setReference($resultCustomer->reference);
      $customer->setFirstName($resultCustomer->firstName);
      $customer->setLastName($resultCustomer->lastName);
      $customer->setEmail($resultCustomer->email);
      $customer->setPhone($resultCustomer->phone);
      $checkout->setCustomer($customer);
    }

    if (isset($result->billingAddress)) {
      $resultBilling = $result->billingAddress;
      $address = new Address();
      $address->setName($resultBilling->name);
      $address->setAddress1($resultBilling->address1);
      $address->setAddress2($resultBilling->address2);
      $address->setCity($resultBilling->city);
      $address->setState($resultBilling->state);
      $address->setZip($resultBilling->zip);
      $address->setCountry($resultBilling->country);
      $checkout->setBillingAddress($address);
    }

    if (isset($result->deliveryAddress)) {
      $resultDelivery = $result->deliveryAddress;
      $address = new Address();
      $address->setName($resultDelivery->name);
      $address->setAddress1($resultDelivery->address1);
      $address->setAddress2($resultDelivery->address2);
      $address->setCity($resultDelivery->city);
      $address->setState($resultDelivery->state);
      $address->setZip($resultDelivery->zip);
      $address->setCountry($resultDelivery->country);
      $checkout->setDeliveryAddress($address);
    }

    return $checkout;
  }

  /***********************************************************************************************
  * HELPER FUNCTIONS
  */

  private function apiCall(string $url, $request){
    try {
      $headers = array(
        'Content-Type: application/json',
        'X-PointCheckout-Api-Key:' . $this->apiKey,
        'X-PointCheckout-Api-Secret:' . $this->apiSecret
      );
      $requestUrl = $this->getApiBaseUrl() . $url;

      $ch = curl_init($requestUrl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      if (!is_null($request)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
      }
      $response = curl_exec($ch);
      $response = json_decode($response);
      if (!$response->success) {
        $errorMessage = isset($response->error) ?
        $response->error :
        'An error occurred while connecting to PAYMENNT service';
        error_log($errorMessage, 0);
        throw new Exception($errorMessage);
      }
      return $response->result;
    } catch (\Exception $ex) {
      error_log("Failed to connect call PointChckout API: " . $ex->getMessage(), 0);
      throw $ex;
    }
  }

  /**
  * getApiBaseUrl(): Returns the API base URL for the slected environment
  */
  private function getApiBaseUrl() {
    if ($this->useTestEnvironment) {
      return PaymenntClient::ENV_URL_TEST;
    } else {
      return PaymenntClient::ENV_URL_LIVE;
    }
  }

  /**
  * echo(): test method
  *
  * @param string $param1 A string containing the parameter, do this for each parameter to the function, make sure to make it descriptive
  * @return string
  */
  public function hello($name){
    $checkout = new Checkout();

    return "Hello " . $name;
  }
}
