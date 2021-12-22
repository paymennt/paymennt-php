<?php namespace Paymennt\branches;

require_once(__DIR__.'/AbstractBranchRequest.php');

use Paymennt\Exception as Exception;

/**
*  Branch class
*
*  new branch creation request class
*
*  @author abdullah
*/
class CreateBranchRequest extends AbstractBranchRequest {


  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
   
    // name validation
    if (!isset($this->name)|| empty($this->name)) {
      throw new Exception("name cannot be null or empty");
    }
   
    // currency validation
    if (!isset($this->currency) || empty($this->currency)) {
      throw new Exception("currency cannot be empty or empty");
    }

    // currency validation
    if (isset($this->currency)) {
      $this->validateCurrencyCode("currency");
    }

    return true;
  }

}
