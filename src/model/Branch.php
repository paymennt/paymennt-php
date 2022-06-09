<?php namespace Paymennt\model;

/**
*  Branch class
*
*  A Branch class representing a PAYMENNT Branch object
*
*  @author abdullah
*/
class Branch {
  /**
  * branch id identifying a branch on the PAYMENNT platform
  * @var string
  */
  public $id;

  /**
  * name of the branch 
  * @var string
  */
  public $name;

  /**
  * the currency of the branch
  * @var string
  */
  public $currency;

  /**
  * the description of the branch
  * @var string
  */
  public $description;

  /**
  * enabled flag for the branch
  * @var string
  */
  public $enabled;

}