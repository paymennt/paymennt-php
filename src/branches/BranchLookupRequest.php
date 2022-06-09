<?php namespace Paymennt\branches;

require_once(__DIR__.'/AbstractBranchRequest.php');

use Paymennt\Exception as Exception;

/**
*  Branch class
*
*  search all branches request class
*
*  @author abdullah
*/
class BranchLookupRequest extends AbstractBranchRequest {

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
  * Generates and returns the query parameters from request
  */
  public function generateQuery() {
    $query="";
    $firstField=true;

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
