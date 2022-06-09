<?php namespace Paymennt;

use Paymennt\model\Branch as Branch;
use Paymennt\model\BranchPage as BranchPage;
use Paymennt\branches\CreateBranchRequest as CreateBranchRequest;
use Paymennt\branches\DisableBranchRequest as DisableBranchRequest;
use Paymennt\branches\EnableBranchRequest as EnableBranchRequest;
use Paymennt\branches\GetBranchRequest as GetBranchRequest;
use Paymennt\branches\BranchLookupRequest as BranchLookupRequest;

use Paymennt\model\Checkout as Checkout;
use Paymennt\model\CheckoutPage as CheckoutPage;
use Paymennt\model\Address as Address;
use Paymennt\model\Item as Item;
use Paymennt\model\Customer as Customer;
use Paymennt\model\Totals as Totals;
use Paymennt\checkout\GetCheckoutRequest as GetCheckoutRequest;
use Paymennt\checkout\CancelCheckoutRequest as CancelCheckoutRequest;
use Paymennt\checkout\LinkCheckoutRequest as LinkCheckoutRequest;
use Paymennt\checkout\MobileCheckoutRequest as MobileCheckoutRequest;
use Paymennt\checkout\QRCheckoutRequest as QRCheckoutRequest;
use Paymennt\checkout\RefundCheckoutRequest as RefundCheckoutRequest;
use Paymennt\checkout\CheckoutLookupRequest as CheckoutLookupRequest;
use Paymennt\checkout\WebCheckoutRequest as WebCheckoutRequest;

use Paymennt\model\Payment as Payment;
use Paymennt\payment\CreatePaymentRequest as CreatePaymentRequest;
use Paymennt\payment\CaptureAuthPaymentRequest as CaptureAuthPaymentRequest;
use Paymennt\payment\GetPaymentRequest as GetPaymentRequest;

use Paymennt\model\Webhook as Webhook;
use Paymennt\model\WebhookPage as WebhookPage;
use Paymennt\webhooks\CreateWebhookRequest as CreateWebhookRequest;
use Paymennt\webhooks\DisableWebhookRequest as DisableWebhookRequest;
use Paymennt\webhooks\EnableWebhookRequest as EnableWebhookRequest;
use Paymennt\webhooks\GetWebhookRequest as GetWebhookRequest;
use Paymennt\webhooks\WebhookLookupRequest as WebhookLookupRequest;
use Paymennt\webhooks\TestWebhookRequest as TestWebhookRequest;
use Paymennt\webhooks\DeleteWebhookRequest as DeleteWebhookRequest;

use Paymennt\model\Subscription as Subscription;
use Paymennt\model\SubscriptionPage as SubscriptionPage;
use Paymennt\model\SubscriptionPayments as SubscriptionPayments;
use Paymennt\subscription\CreateSubscriptionRequest as CreateSubscriptionRequest;
use Paymennt\subscription\GetSubscriptionRequest as GetSubscriptionRequest;
use Paymennt\subscription\SubscriptionLookupRequest as SubscriptionLookupRequest;
use Paymennt\subscription\PauseSubscriptionRequest as PauseSubscriptionRequest;
use Paymennt\subscription\ResumeSubscriptionRequest as ResumeSubscriptionRequest;
use Paymennt\subscription\GetSubscriptionPaymentsRequest as GetSubscriptionPaymentsRequest;


/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author bashar
*/
final class PaymenntClient {

  private const ENV_URL_LIVE  = "https://api.paymennt.com/mer/v2.0/";
  private const ENV_URL_TEST  = "https://api.test.paymennt.com/mer/v2.0/";

  private const URL_CHECKOUT = "checkout/";
  private const URL_CHECKOUT_LOOKUP = "checkout?";
  private const URL_CHECKOUT_WEB = "checkout/web";
  private const URL_CHECKOUT_MOBILE = "checkout/mobile";
  private const URL_CHECKOUT_QR= "checkout/qr";
  private const URL_CHECKOUT_LINK = "checkout/link";

  private const URL_PAYMENT = "payment/";
  private const URL_PAYMENT_CREATE = "payment/debit";
  
  private const URL_BRANCH = "branches/";
  private const URL_BRANCH_LOOKUP = "branches?";

  private const URL_WEBHOOK = "webhooks/";
  private const URL_WEBHOOK_LOOKUP = "webhooks?";
  
  private const URL_SUBSCRIBE = "subscription/";
  private const URL_SUBSCRIBE_LOOKUP = "subscription?";
  
  /**  @var string $apiKey the PAYMENNT API Key */
  private $apiKey;

  /**  @var string $apiSecret the PAYMENNT API Secret */
  private $apiSecret;

  /**  @var string $useTestEnvironment Whether or not to use the test environment */
  private $useTestEnvironment = false;

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

  public function createWebCheckout(WebCheckoutRequest $webCheckoutRequest) : Checkout {
    if (!isset($webCheckoutRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $webCheckoutRequest->validate();
    $url = PaymenntClient::URL_CHECKOUT_WEB;
    $result = $this->apiCall($url, $webCheckoutRequest);
    return $this->parseCheckoutResult($result);
  }

  public function createMobileCheckout(MobileCheckoutRequest $mobileCheckoutRequest) : Checkout {
    if (!isset($mobileCheckoutRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $mobileCheckoutRequest->validate();
    $url = PaymenntClient::URL_CHECKOUT_MOBILE;
    $result = $this->apiCall($url, $mobileCheckoutRequest);
    return $this->parseCheckoutResult($result);
  }

  public function createQRCheckout(QRCheckoutRequest $qrCheckoutRequest) : Checkout {
    if (!isset($qrCheckoutRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $qrCheckoutRequest->validate();
    $url = PaymenntClient::URL_CHECKOUT_LINK;
    $result = $this->apiCall($url, $qrCheckoutRequest);
    return $this->parseCheckoutResult($result);
  }
 
  public function createLinkCheckout(LinkCheckoutRequest $linkCheckoutRequest) : Checkout {
    if (!isset($linkCheckoutRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $linkCheckoutRequest->validate();
    $url = PaymenntClient::URL_CHECKOUT_LINK;
    $result = $this->apiCall($url, $linkCheckoutRequest);
    return $this->parseCheckoutResult($result);
  }

  public function checkoutLookupRequest(CheckoutLookupRequest $checkoutLookupRequest) : CheckoutPage {
    if (!isset($checkoutLookupRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $checkoutLookupRequest->validate();
    $queryParam= $checkoutLookupRequest->generateQuery();
    $url = PaymenntClient::URL_CHECKOUT_LOOKUP ."/". $queryParam;
    $result = $this->apiCall($url, NULL);
    return $this->parseCheckoutPageResult($result);
  }

  public function getCheckoutRequest(GetCheckoutRequest $getCheckoutRequest) : Checkout {
    if (!isset($getCheckoutRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $getCheckoutRequest->validate();
    return $this->getCheckout($getCheckoutRequest->checkoutId);
  }
  
  public function cancelCheckoutRequest(CancelCheckoutRequest $cancelCheckoutRequest) : Checkout {
    if (!isset($cancelCheckoutRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $cancelCheckoutRequest->validate();
    $pathParam=$cancelCheckoutRequest->checkoutId . "/cancel";
    $url = PaymenntClient::URL_CHECKOUT . $pathParam;
    $result = $this->apiCall($url, $cancelCheckoutRequest);
    return $this->parseCheckoutResult($result);
  }

  public function refundCheckoutRequest(RefundCheckoutRequest $refundCheckoutRequest) : Checkout {
    if (!isset($refundCheckoutRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $refundCheckoutRequest->validate();
    $note=str_replace(" ", "%20", $refundCheckoutRequest->note ); 
    $pathParam=$refundCheckoutRequest->checkoutId . "/refund?note=" . $note;
    $url = PaymenntClient::URL_CHECKOUT . $pathParam;
    $result = $this->apiCall($url, $refundCheckoutRequest);
    return $this->parseCheckoutResult($result);
  }
  

  /***********************************************************************************************
  * PAYMENT API CALLS
  */

  public function getPayment(string $paymentId) : Payment {
    $url = PaymenntClient::URL_PAYMENT . $paymentId;
    $result = $this->apiCall($url, null);
    return $this->parsePaymentResult($result);
  }

  public function getPaymentRequest(GetPaymentRequest $getPaymentRequest) : Payment {
    if (!isset($getPaymentRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $getPaymentRequest->validate();
    return $this->getPayment($getPaymentRequest->paymentId);
  }
  
  public function createPayment(CreatePaymentRequest $createPaymentRequest) : Payment {
    if (!isset($createPaymentRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $createPaymentRequest->validate();
    $url = PaymenntClient::URL_PAYMENT_CREATE;
    $result = $this->apiCall($url, $createPaymentRequest);
    return $this->parsePaymentResult($result);
  }

  public function captureAuthorizedPayment(CaptureAuthPaymentRequest $captureAuthPaymentRequest) : Payment {
    if (!isset($captureAuthPaymentRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $captureAuthPaymentRequest->validate();
    $pathParam=$captureAuthPaymentRequest->paymentId . "/capture";
    $url = PaymenntClient::URL_PAYMENT . $pathParam;
    $result = $this->apiCall($url, $captureAuthPaymentRequest);
    return $this->parsePaymentResult($result);
  }


  /***********************************************************************************************
  * BRANCHES API CALLS
  */

  public function getBranch(string $branchId) : Branch {
    $url = PaymenntClient::URL_BRANCH. $branchId;
    $result = $this->apiCall($url, null);
    return $this->parseBranchResult($result);
  }
  
  public function getBranchRequest(GetBranchRequest $getBranchRequest) : Branch {
    if (!isset($getBranchRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $getBranchRequest->validate();
    return $this->getBranch($getBranchRequest->branchId);
  }

  public function branchLookupRequest(BranchLookupRequest $branchLookupRequest) : BranchPage {
    if (!isset($branchLookupRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $branchLookupRequest->validate();
    $queryParam= $branchLookupRequest->generateQuery();
    $url = PaymenntClient::URL_BRANCH_LOOKUP . $queryParam;
    $result = $this->apiCall($url, NULL);
    return $this->parseBranchPageResult($result);
  }

  public function createBranch(CreateBranchRequest $createBranchRequest) : Branch {
    if (!isset($createBranchRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $createBranchRequest->validate();
    $url = PaymenntClient::URL_BRANCH;
    $result = $this->apiCall($url, $createBranchRequest);
    return $this->parseBranchResult($result);
  }

  public function disableBranchRequest(DisableBranchRequest $disbleBranchRequest) : Branch {
    if (!isset($disbleBranchRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $disbleBranchRequest->validate();
    $pathParam=$disbleBranchRequest->branchId . "/disable";
    $url = PaymenntClient::URL_BRANCH . $pathParam;
    $result = $this->apiCall($url, $disbleBranchRequest);
    return $this->parseBranchResult($result);
  }

  public function enableBranchRequest(EnableBranchRequest $enableBranchRequest) : Branch {
    if (!isset($enableBranchRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $enableBranchRequest->validate();
    $pathParam=$enableBranchRequest->branchId . "/enable";
    $url = PaymenntClient::URL_BRANCH . $pathParam;
    $result = $this->apiCall($url, $enableBranchRequest);
    return $this->parseBranchResult($result);
  }

/***********************************************************************************************
  * WEBHOOKS API CALLS
  */

  public function getWebhook(string $webhookId) : Webhook {
    $url = PaymenntClient::URL_WEBHOOK. $webhookId;
    $result = $this->apiCall($url, null);
    return $this->parseWebhookResult($result);
  }
  
  public function getWebhookRequest(GetWebhookRequest $getWebhookRequest) : Webhook {
    if (!isset($getWebhookRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $getWebhookRequest->validate();
    return $this->getWebhook($getWebhookRequest->webhookId);
  }

  public function webhookLookupRequest(WebhookLookupRequest $webhookLookupRequest) : WebhookPage {
    if (!isset($webhookLookupRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $webhookLookupRequest->validate();
    $queryParam= $webhookLookupRequest->generateQuery();
    $url = PaymenntClient::URL_WEBHOOK_LOOKUP . $queryParam;
    $result = $this->apiCall($url, NULL);
    return $this->parseWebhookPageResult($result);
  }

  public function createWebhook(CreateWebhookRequest $createWebhookRequest) : Webhook {
    if (!isset($createWebhookRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $createWebhookRequest->validate();
    $url = PaymenntClient::URL_WEBHOOK;
    $result = $this->apiCall($url, $createWebhookRequest);
    return $this->parseWebhookResult($result);
  }

  public function testWebhookRequest(TestWebhookRequest $testWebhookRequest) : bool {
    if (!isset($testWebhookRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $testWebhookRequest->validate();
    $pathParam=$testWebhookRequest->webhookId . "/test";
    $url = PaymenntClient::URL_WEBHOOK . $pathParam;
    $result = $this->apiCall($url, $testWebhookRequest);
    return $result;
  }

  public function disableWebhookRequest(DisableWebhookRequest $disbleWebhookRequest) : Webhook {
    if (!isset($disbleWebhookRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $disbleWebhookRequest->validate();
    $pathParam=$disbleWebhookRequest->webhookId . "/disable";
    $url = PaymenntClient::URL_WEBHOOK . $pathParam;
    $result = $this->apiCall($url, $disbleWebhookRequest);
    return $this->parseWebhookResult($result);
  }

  public function enableWebhookRequest(EnableWebhookRequest $enableWebhookRequest) : Webhook {
    if (!isset($enableWebhookRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $enableWebhookRequest->validate();
    $pathParam=$enableWebhookRequest->webhookId . "/enable";
    $url = PaymenntClient::URL_WEBHOOK . $pathParam;
    $result = $this->apiCall($url, $enableWebhookRequest);
    return $this->parseWebhookResult($result);
  }

  public function deleteWebhookRequest(DeleteWebhookRequest $deleteWebhookRequest) : bool {
    if (!isset($deleteWebhookRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $deleteWebhookRequest->validate();
    $pathParam=$deleteWebhookRequest->webhookId . "/delete";
    $url = PaymenntClient::URL_WEBHOOK . $pathParam;
    $result = $this->apiCall($url, $deleteWebhookRequest);
    return $result;
  }



/***********************************************************************************************
  * CUSTOMER SUBSCRIPTION API CALLS
  */

  public function getSubscription(string $subscriptionId) : Subscription {
    $url = PaymenntClient::URL_SUBSCRIBE. $subscriptionId;
    $result = $this->apiCall($url, null);
    return $this->parseSubscriptionResult($result);
  }
  
  public function getSubscriptionRequest(GetSubscriptionRequest $getSubscriptionRequest) : Subscription {
    if (!isset($getSubscriptionRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $getSubscriptionRequest->validate();
    return $this->getSubscription($getSubscriptionRequest->subscriptionId);
  }

  public function subscriptionLookupRequest(SubscriptionLookupRequest $subscriptionLookupRequest) : SubscriptionPage {
    if (!isset($subscriptionLookupRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $subscriptionLookupRequest->validate();
    $queryParam=$subscriptionLookupRequest->generateQuery();
    $url = PaymenntClient::URL_SUBSCRIBE_LOOKUP . $queryParam;
    $result = $this->apiCall($url, NULL);
    return $this->parseSubscriptionPageResult($result);
  }

  public function createSubscription(CreateSubscriptionRequest $createSubscriptionRequest) : Subscription {
    if (!isset($createSubscriptionRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $createSubscriptionRequest->validate();
    $url = PaymenntClient::URL_SUBSCRIBE;
    $result = $this->apiCall($url, $createSubscriptionRequest);
    return $this->parseSubscriptionResult($result);
  }

  public function pauseSubscriptionRequest(PauseSubscriptionRequest $pauseSubscriptionRequest) : Subscription {
    if (!isset($pauseSubscriptionRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $pauseSubscriptionRequest->validate();
    $pathParam=$pauseSubscriptionRequest->subscriptionId . "/pause";
    $url = PaymenntClient::URL_SUBSCRIBE . $pathParam;
    $result = $this->apiCall($url, $pauseSubscriptionRequest);
    return $this->parseSubscriptionResult($result);
  }

  public function resumeSubscriptionRequest(ResumeSubscriptionRequest $resumeSubscriptionRequest) : Subscription {
    if (!isset($resumeSubscriptionRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $resumeSubscriptionRequest->validate();
    $pathParam=$resumeSubscriptionRequest->subscriptionId . "/resume";
    $url = PaymenntClient::URL_SUBSCRIBE . $pathParam;
    $result = $this->apiCall($url, $resumeSubscriptionRequest);
    return $this->parseSubscriptionResult($result);
  }

  public function getSubscriptionPaymentsRequest(GetSubscriptionPaymentsRequest $subscriptionPaymentsRequest) : SubscriptionPayments {
    if (!isset($subscriptionPaymentsRequest)) {
      throw new Exception("request cannot be null or empty");
    }
    $subscriptionPaymentsRequest->validate();
    $queryParam=$subscriptionPaymentsRequest->generateQuery();
    $pathParam=$subscriptionPaymentsRequest->subscriptionId . "/payment?" . $queryParam;
    $url = PaymenntClient::URL_SUBSCRIBE . $pathParam;
    $result = $this->apiCall($url, null);
    return $this->parseSubscriptionPaymentsResult($result);
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
    $checkout->cashAmount = $result->cashAmount;
    $checkout->totalRefunded = $result->totalRefunded;
    $checkout->status = $result->status;
    $checkout->redirectUrl = $result->redirectUrl;
    $checkout->branchId = $result->branchId;
    $checkout->branchName = $result->branchName;
    $checkout->usedPaymentMethod = $result->usedPaymentMethod;
    $checkout->timestamp = $result->timestamp;

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

  private function parseCheckoutPageResult($result) {
    $checkoutPage = new CheckoutPage();
    $checkoutPage->page = $result->page;
    $checkoutPage->size = $result->size;
    $checkoutPage->totalPages = $result->totalPages;
    $checkoutPage->totalElements = $result->totalElements;

    foreach($result->content as $con) {
      $checkout=$this->parseCheckoutResult ($con);
      $checkoutPage->content[]= $checkout;
    }
    return $checkoutPage;
  }

  private function parsePaymentResult($result) {
    $payment = new Payment();
    $payment->id = $result->id;
    $payment->currency = $result->currency;
    $payment->amount = $result->amount;
    $payment->status = $result->status;
    $payment->redirectUrl = $result->redirectUrl;
    $payment->responseMessage = $result->responseMessage;
    $payment->checkoutDetails = $this->parseCheckoutResult ($result->checkoutDetails);
    
    return $payment;
  }


  private function parseBranchResult($result) {
    $branch = new Branch();
    $branch->name = $result->name;
    $branch->currency = $result->currency;
    
    # values not present in every API call
    if (isset($result->id)) {
      $branch->id = $result->id;
    }
    if (isset($result->description)) {
      $branch->description = $result->description;
    }

    if (isset($result->enabled)) {
      $branch->enabled = $result->enabled;
    }
    return $branch;
  }

  private function parseBranchPageResult($response) {
    $branchPage = new BranchPage();
    
    foreach($response as $branch) {
      $tempBranch=$this->parseBranchResult($branch);
      $branchPage->content[]= $tempBranch;
    }
    return $branchPage;
  }

  private function parseWebhookResult($result) {
    $webhook = new Webhook();
    
    # values not present in every API call
    if (isset($result->id)) {
      $webhook->id = $result->id;
    }
    if (isset($result->hmacKey)) {
      $webhook->hmacKey = $result->hmacKey;
    }
    if (isset($result->address)) {
      $webhook->address = $result->address;
    }
    if (isset($result->failed)) {
      $webhook->failed = $result->failed;
    }

    if (isset($result->enabled)) {
      $webhook->enabled = $result->enabled;
    }
    return $webhook;
  }

  private function parseWebhookPageResult($response) {
    $webhookPage = new WebhookPage();
    
    foreach($response as $webhook) {
      $tempWebhook=$this->parseWebhookResult($webhook);
      $webhookPage->content[]= $tempWebhook;
    }

    return $webhookPage;
  }

  private function parseSubscriptionResult($result) {
    $subscription = new Subscription();
    
    $subscription->id = $result->id;
    $subscription->displayId = $result->displayId;
    
    # values not present in every API call

    if (isset($result->description)) {
      $subscription->description = $result->description;
    } 
    if (isset($result->currency)) {
      $subscription->currency = $result->currency;
    } 
    if (isset($result->amount)) {
      $subscription->amount = $result->amount;
    } 
    if (isset($result->status)) {
      $subscription->status = $result->status;
    }
    if (isset($result->startDate)) {
      $subscription->startDate = $result->startDate;
    }
    if (isset($result->sendOnHour)) {
      $subscription->sendOnHour = $result->sendOnHour;
    } 
    if (isset($result->timestamp)) {
      $subscription->timestamp = $result->timestamp;
    }
    if (isset($result->cancelled)) {
      $subscription->cancelled = $result->cancelled;
    }

    if (isset($result->customer)) {
      $customer = $result->customer;
      $subscription->customer = new Customer();
      $subscription->customer->id = $customer->id;
      $subscription->customer->reference = $customer->reference;
      $subscription->customer->firstName = $customer->firstName;
      $subscription->customer->lastName = $customer->lastName;
      $subscription->customer->email = $customer->email;
      $subscription->customer->phone = $customer->phone;
    }

    if (isset($result->endDate)) {
      $subscription->endDate = $result->endDate;
    }
    if (isset($result->period)) {
      $subscription->period = $result->period;
    }
    if (isset($result->periodUnit)) {
      $subscription->periodUnit = $result->periodUnit;
    }
    if (isset($result->checkout)) {
      $subscription->checkout = $this->parseCheckoutResult($result->checkout);
    }
    return $subscription;
  }

  private function parseSubscriptionPageResult($result) {
    $subscriptionPage = new SubscriptionPage();
    
    $subscriptionPage->page = $result->page;
    $subscriptionPage->size = $result->size;
    $subscriptionPage->totalPages = $result->totalPages;
    $subscriptionPage->totalElements = $result->totalElements;

    foreach($result->content as $subscription) {
      $tempSubscription=$this->parseSubscriptionResult($subscription);
      $subscriptionPage->content[]= $tempSubscription;
    }

    return $subscriptionPage;
  }

  private function parseSubscriptionPaymentsResult($result) {
    $subscriptionPayments = new SubscriptionPayments();
    
    $subscriptionPayments->page = $result->page;
    $subscriptionPayments->size = $result->size;
    $subscriptionPayments->totalPages = $result->totalPages;
    $subscriptionPayments->totalElements = $result->totalElements;

    foreach($result->content as $subscription) {
      $tempPayments=$this->parseSubscriptionResult($subscription);
      $subscriptionPayments->content[]= $tempPayments;
    }

    return $subscriptionPayments;
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
        if(isset($response->result))
          return $response->result;
        else
          return $response->success;

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
 