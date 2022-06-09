<?php namespace Paymennt\subscription;

require_once(__DIR__.'/AbstractSubscriptionRequest.php');
use Paymennt\Exception as Exception;

/**
*  Subscription class
*
*  get subscription payments by subscriptionId request class
*
*  @author abdullah
*/

class GetSubscriptionPaymentsRequest extends AbstractSubscriptionRequest {
  /**
  * page number, default is 0
  * @var string
  */
  public $page;

  /**
  * page size, default is 20
  * @var string
  */
  public $size;

  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
   
    // subscriptionId validation
    if (!isset($this->subscriptionId)|| empty($this->subscriptionId)) {
      throw new Exception("subscriptionId cannot be null or empty");
    }
    return true;
  }

  public function generateQuery() {
    $query="";
    $firstField=true;

    if (!is_null($this->subscriptionId)){
      if($firstField)
      $query=$query . "subscriptionId=" . $this->subscriptionId;
      else
      $query=$query . "&subscriptionId=" . $this->subscriptionId;
      $firstField=false;
    }
    if (!is_null($this->page)){
      if($firstField)
      $query=$query . "page=" . $this->page;
      else
      $query=$query . "&page=" . $this->page;
      $firstField=false;
    }
    if (!is_null($this->size)){
      if($firstField)
      $query=$query . "size=" . $this->size;
      else
      $query=$query . "&size=" . $this->size;
      $firstField=false;
    }

    return $query;
  }

}
