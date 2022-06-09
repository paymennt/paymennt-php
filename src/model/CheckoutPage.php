<?php namespace Paymennt\model;

/**
*  Checkout class
*
*  A checkout class representing a PAYMENNT checkout object
*
*  @author bashar
*/
class CheckoutPage {
  /**
  * the number of current page showing, starts from 0, default 0
  * @var int
  */
  public $page;

  /**
  * number of results per page, default 20
  * @var int
  */
  public $size;

  /**
  * the total numbers of pages of result present
  */
  public $totalPages;

  /**
  * the total number of elements qualifying the serach conditions
  * @var int
  */
  public $totalElements;

  /**
  * merchant customer associated with this checkout
  * @var Customer
  */
  public $content=array();
  
}