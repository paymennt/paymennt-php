<?php namespace Paymennt\model;

/**
*  Subscription class
*
*  A subscription class representing a PAYMENNT search result of subscription payments
*
*  @author abdullah
*/
class SubscriptionPayments{

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
  * array of subscription payment objects
  * @var array
  */
  public $content=array();
  
}