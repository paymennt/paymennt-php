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
  private const URL_CHECKOUT_WEB = "checkout/web";

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
    return $this->parseCheckoutResult($result);
  }

  /***********************************************************************************************
  * CHECKOUT API CALLS
  */

  public function createWebCheckout(WebCheckoutRequest $webCheckoutRequest) : Checkout {
    if (!isset($webCheckoutRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $url = PaymenntClient::URL_CHECKOUT_WEB;
    $result = $this->apiCall($url, $webCheckoutRequest);
    return $this->parseCheckoutResult($result);
  }

  /***********************************************************************************************
  * HELPER FUNCTIONS
  */
  private function parseCheckoutResult($result) {
    $checkout = new Checkout();
    $checkout->id = $result->id;
    $checkout->displayId = $result->displayId;
    $checkout->checkoutKey = $result->checkoutKey;
    $checkout->requestId = $result->requestId;
    $checkout->orderId = $result->orderId;
    $checkout->currency = $result->currency;
    $checkout->amount = $result->amount;
    $checkout->status = $result->status;
    $checkout->redirectUrl = $result->redirectUrl;
    $checkout->branchId = $result->branchId;
    $checkout->branchName = $result->branchName;
    $checkout->usedPaymentMethod = $result->usedPaymentMethod;

    # values not present in every API call
    if (isset($result->base64QR)) {
      $checkout->base64QR = $result->base64QR;
    }
    if (isset($result->subscriptionId)) {
      $checkout->subscriptionId = $result->subscriptionId;
    }

    if (isset($result->customer)) {
      $customer = $result->customer;
      $checkout->customer = new Customer();
      $checkout->customer->id = $customer->id;
      $checkout->customer->reference = $customer->reference;
      $checkout->customer->firstName = $customer->firstName;
      $checkout->customer->lastName = $customer->lastName;
      $checkout->customer->email = $customer->email;
      $checkout->customer->phone = $customer->phone;
    }

    if (isset($result->billingAddress)) {
      $address = $result->billingAddress;
      $checkout->billingAddress = new Address();
      $checkout->billingAddress->name = $address->name;
      $checkout->billingAddress->address1 = $address->address1;
      $checkout->billingAddress->address2 = $address->address2;
      $checkout->billingAddress->city = $address->city;
      $checkout->billingAddress->state = $address->state;
      $checkout->billingAddress->zip = $address->zip;
      $checkout->billingAddress->country = $address->country;
    }

    if (isset($result->deliveryAddress)) {
      $address = $result->deliveryAddress;
      $checkout->deliveryAddress = new Address();
      $checkout->deliveryAddress->name = $address->name;
      $checkout->deliveryAddress->address1 = $address->address1;
      $checkout->deliveryAddress->address2 = $address->address2;
      $checkout->deliveryAddress->city = $address->city;
      $checkout->deliveryAddress->state = $address->state;
      $checkout->deliveryAddress->zip = $address->zip;
      $checkout->deliveryAddress->country = $address->country;
    }

    return $checkout;
  }

  /***********************************************************************************************
  * HELPER FUNCTIONS
  */

  private function apiCall(string $url, $request) {
    $headers = array(
      'Content-Type: application/json',
      'X-PointCheckout-Api-Key:' . $this->apiKey,
      'X-PointCheckout-Api-Secret:' . $this->apiSecret
    );
    $requestUrl = $this->getApiBaseUrl() . $url;

    $ch = curl_init($requestUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    # curl_setopt($ch, CURLOPT_FAILONERROR, true);
    if (!is_null($request)) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
    }

    try {
      $response = curl_exec($ch);
      $response = json_decode($response);
      if (isset($response) && $response->success) {
        return $response->result;
      }
      $errorMessage = "An error occurred while connecting to PAYMENNT service";
      if (isset($response) && isset($response->error)) {
        $errorMessage = $response->error;
      } else if (curl_errno($ch)) {
        $errorMessage = $errorMessage . ": " . curl_error($ch);
      }
      throw new Exception($errorMessage);
    } finally {
      curl_close($ch);
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

}
