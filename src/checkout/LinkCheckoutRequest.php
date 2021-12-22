<?php namespace Paymennt\checkout;

require_once(__DIR__.'/AbstractCheckoutRequest.php');
use Paymennt\Exception as Exception;

/**
*  Checkout class
*
*  A link checkout request class
*
*  @author abdullah
*/
class LinkCheckoutRequest extends AbstractCheckoutRequest {

  /**
  * Description of the order
  * @var string
  */
  public $description;
  /**
  * send SMS flag for the checkout 
  * @var bool
  */
  public $sendSms;

  /**
  * send E-mail flag for the checkout
  * @var bool
  */
  public $sendEmail;

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

    // description validation
    if (!isset($this->description) || empty($this->description)) {
      throw new Exception("description cannot be empty");
    }

   // link expiry time  validation
   if (isset($this->expiresIn)) {
    if(!((int)$this->expiresIn>=5 && (int)$this->expiresIn<=10080 && $this->validateWholeNumber("expiresIn")))
    throw new Exception("Invalid expiresIn value, must be number of minutes (5..10800) ");
  }
  

    return true;
  }

}
