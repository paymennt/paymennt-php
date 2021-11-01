<?php namespace Paymennt;

/**
*  Customer class
*
*  Class representing a customer
*
*  @author bashar
*/
class Customer {
  /**
  * customer identifier in the PAYMENNT platform
  * @var string
  */
  private $id;

  /**
  * customer identifier in the merchant system
  * @var string
  */
  private $reference;

  /**
  * customer first name
  * @var string
  */
  private $firstName;

  /**
  * customer last name
  * @var string
  */
  private $lastName;

  /**
  * Customer email address
  * @var string
  */
  private $email;

  /**
  * customer phone number with international calling code (Ex. 971567xxxxxx)
  * @var string
  */
  private $phone;

  /*************************************************************************************************
  * GETTERS AND SETTERS
  */

  /**
  * Get the value of customer identifier in the PAYMENNT platform
  * @return string
  */
  public function getId() {
    return $this->id;
  }

  /**
  * Set the value of customer identifier in the PAYMENNT platform
  * @param string $id
  * @return self
  */
  public function setId(string $id) {
    $this->id = $id;
    return $this;
  }

  /**
  * Get the value of customer identifier in the merchant system
  * @return string
  */
  public function getReference() {
    return $this->reference;
  }

  /**
  * Set the value of customer identifier in the merchant system
  * @param string $reference
  * @return self
  */
  public function setReference(string $reference) {
    $this->reference = $reference;
    return $this;
  }

  /**
  * Get the value of customer first name
  * @return string
  */
  public function getFirstName() {
    return $this->firstName;
  }

  /**
  * Set the value of customer first name
  * @param string $firstName
  * @return self
  */
  public function setFirstName(string $firstName) {
    $this->firstName = $firstName;
    return $this;
  }

  /**
  * Get the value of customer last name
  * @return string
  */
  public function getLastName() {
    return $this->lastName;
  }

  /**
  * Set the value of customer last name
  * @param string $lastName
  * @return self
  */
  public function setLastName(string $lastName) {
    $this->lastName = $lastName;
    return $this;
  }

  /**
  * Get the value of Customer email address
  * @return string
  */
  public function getEmail() {
    return $this->email;
  }

  /**
  * Set the value of Customer email address
  * @param string $email
  * @return self
  */
  public function setEmail(string $email) {
    $this->email = $email;
    return $this;
  }

  /**
  * Get the value of customer phone number with international calling code (Ex. 971567xxxxxx)
  * @return string
  */
  public function getPhone() {
    return $this->phone;
  }

  /**
  * Set the value of customer phone number with international calling code (Ex. 971567xxxxxx)
  * @param string $phone
  * @return self
  */
  public function setPhone(string $phone) {
    $this->phone = $phone;
    return $this;
  }

}
