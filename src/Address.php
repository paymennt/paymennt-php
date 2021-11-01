<?php namespace Paymennt;

/**
*  Address class
*
*  Class representing a customer address
*
*  @author bashar
*/
class Address {
  /**
  * name on address
  * @var string
  */
  private $name;

  /**
  * address line 1
  * @var string
  */
  private $address1;

  /**
  * address line 2
  * @var string
  */
  private $address2;

  /**
  * address city
  * @var string
  */
  private $city;

  /**
  * address state
  * @var string
  */
  private $state;

  /**
  * address zip or post code
  * @var string
  */
  private $zip;

  /**
  * address ISO 3-letter country code (Ex. USA, FRA, UAE, KSA, IND, etc)
  * @var string
  */
  private $country;

  /*************************************************************************************************
  * GETTERS AND SETTERS
  */

  /**
  * Get the value of name on address
  * @return string
  */
  public function getName() {
    return $this->name;
  }

  /**
  * Set the value of name on address
  * @param string $name
  * @return self
  */
  public function setName(string $name) {
    $this->name = $name;
    return $this;
  }

  /**
  * Get the value of address line 1
  * @return string
  */
  public function getAddress1() {
    return $this->address1;
  }

  /**
  * Set the value of address line 1
  * @param string $address1
  * @return self
  */
  public function setAddress1(string $address1) {
    $this->address1 = $address1;
    return $this;
  }

  /**
  * Get the value of address line 2
  * @return string
  */
  public function getAddress2() {
    return $this->address2;
  }

  /**
  * Set the value of address line 2
  * @param string $address2
  * @return self
  */
  public function setAddress2(?string $address2) {
    $this->address2 = $address2;
    return $this;
  }

  /**
  * Get the value of address city
  * @return string
  */
  public function getCity() {
    return $this->city;
  }

  /**
  * Set the value of address city
  * @param string $city
  * @return self
  */
  public function setCity(string $city) {
    $this->city = $city;
    return $this;
  }

  /**
  * Get the value of address state
  * @return string
  */
  public function getState() {
    return $this->state;
  }

  /**
  * Set the value of address state
  * @param string $state
  * @return self
  */
  public function setState(?string $state) {
    $this->state = $state;
    return $this;
  }

  /**
  * Get the value of address zip or post code
  * @return string
  */
  public function getZip() {
    return $this->zip;
  }

  /**
  * Set the value of address zip or post code
  * @param string $zip
  * @return self
  */
  public function setZip(?string $zip) {
    $this->zip = $zip;
    return $this;
  }

  /**
  * Get the value of address ISO 3-letter country code (Ex. USA, FRA, UAE, KSA, IND, etc)
  * @return string
  */
  public function getCountry() {
    return $this->country;
  }

  /**
  * Set the value of address ISO 3-letter country code (Ex. USA, FRA, ARE, KSA, IND, etc)
  * @param string $country
  * @return self
  */
  public function setCountry(string $country) {
    $this->country = $country;
    return $this;
  }
}
