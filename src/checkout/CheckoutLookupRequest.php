<?php namespace Paymennt\checkout;

require_once(__DIR__.'/AbstractCheckoutRequest.php');

/**
*  Checkout class
*
*  a search checkout based on passed params request class
*
*  @author abdullah
*/
class CheckoutLookupRequest extends AbstractCheckoutRequest {

  /**
  * The type of payment to search for
  * @var string
  */
  public $type;

  /**
  * The status of payment to search for
  * @var string
  */
  public $status;

  /**
  * filter checkouts after the provided id
  * @var string
  */
  public $afterId;

  /**
  * query checkouts created after specific date/time, date format is yyyy-mm-dd HH:MM:SS
  * @var string
  */
  public $afterTimestamp;

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

    return true;
  }

  /**
  * Generates and returns the GET request query parameters from request
  */
  public function generateQuery() {
      $query="";
      $firstField=true;

      if (!is_null($this->type)){
        if($firstField)
        $query=$query . "type=" . $this->type;
        else
        $query=$query . "&type=" . $this->type;
        $firstField=false;
      }
      if (!is_null($this->requestId)){
        if($firstField)
        $query=$query . "requestId=" . $this->requestId;
        else
        $query=$query . "&requestId=" . $this->requestId;
        $firstField=false;
      }
      if (!is_null($this->orderId)){
        if($firstField)
        $query=$query . "orderId=" . $this->orderId;
        else
        $query=$query . "&orderId=" . $this->orderId;
        $firstField=false;
      }
      if (!is_null($this->status)){
        if($firstField)
        $query=$query . "status=" . $this->status;
        else
        $query=$query . "&status=" . $this->status;
        $firstField=false;
      }
      if (!is_null($this->customer->reference)){
        if($firstField)
        $query=$query . "customer.reference=" . $this->customer->reference;
        else
        $query=$query . "&customer.reference=" . $this->customer->reference;
        $firstField=false;
      }
      if (!is_null($this->customer->email)){
        if($firstField)
        $query=$query . "customer.email=" . $this->customer->email;
        else
        $query=$query . "&customer.email=" . $this->customer->email;
        $firstField=false;
      }
      if (!is_null($this->customer->phone)){
        if($firstField)
        $query=$query . "customer.phone=" . $this->customer->phone;
        else
        $query=$query . "&customer.phone=" . $this->customer->phone;
        $firstField=false;
      }
      if (!is_null($this->afterId)){
        if($firstField)
        $query=$query . "afterId=" . $this->afterId;
        else
        $query=$query . "&afterId=" . $this->afterId;
        $firstField=false;
      }
      if (!is_null($this->afterTimestamp)){
        if($firstField)
        $query=$query . "afterTimestamp=". $this->afterTimestamp;
        else
        $query=$query . "&afterTimestamp=" . $this->afterTimestamp;
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
