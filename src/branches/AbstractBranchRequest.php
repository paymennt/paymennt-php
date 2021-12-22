<?php namespace Paymennt\branches;

require_once(__DIR__.'/../Validatable.php');

use Paymennt\Exception as Exception;

/**
*  Branch class
*
*  A Branch class representing a PAYMENNT branch object
*
*  @author abdullah
*/
abstract class AbstractBranchRequest extends \Paymennt\Validatable {

  /**
  * branch id identifying this branch on the PAYMENNT platform
  * @var string
  */
  public $branchId;

  /**
  * name for the branch 
  * @var string
  */
  public $name;

  /**
  * the currency of the branch
  * @var string
  */
  public $currency;


  /*************************************************
  * CLASS METHODS
  */

  /**
  * Validates instasnce values. Throws exception if invalid
  */
  public function validate() {
    return true;
  }

}
