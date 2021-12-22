<?php namespace Paymennt\checkout;

require_once(__DIR__.'/AbstractCheckoutRequest.php');
use Paymennt\Exception as Exception;

/**
*  Checkout class
*
*  A QR checkout request class
*
*  @author bashar
*/
class QRCheckoutRequest extends AbstractCheckoutRequest {


  /**
  * default QR description to use for the checkout form
  * @var string
  */
  public $description;
  /**
  * default device-Reference to use for the checkout form
  * @var string
  */
  public $deviceReference;

  /**
  * default QR-Size to use for the checkout form
  * @var string
  */
  public $qrSize;

  /**
  * number of minutes (15..10080) the payment will remain available, after that the payment will expire..
  * @var int
  */
  public $expiresIn;
  


  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    // parent validation
    parent::validate();

    
    // QR Size validation
    if (isset($this->qrSize)) {
      if($this->validateWholeNumber("qrSize") && !((int)$this->qrSize>=64 && (int)$this->qrSize<=1024 ))
      throw new Exception("Invalid QR Size, must be a number (64..1024) ");
    }

    // QR expiry time  validation
    if (isset($this->expiresIn)) {
      if(!((int)$this->expiresIn>=5 && (int)$this->expiresIn<=10080 && $this->validateWholeNumber("expiresIn")))
      throw new Exception("Invalid expiresIn value, must be number of minutes (5..10800) ");
    }
    
    return true;
  }

}
