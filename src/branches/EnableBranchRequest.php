<?php namespace Paymennt\branches;

require_once(__DIR__.'/AbstractBranchRequest.php');

use Paymennt\Exception as Exception;

/**
*  Branch class
*
*  enable branch by branchId request class
*
*  @author abdullah
*/

class EnableBranchRequest extends AbstractBranchRequest {

  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
   
    // branchId validation
    if (!isset($this->branchId)|| empty($this->branchId)) {
      throw new Exception("branchId cannot be null or empty");
    }

    return true;
  }

}
