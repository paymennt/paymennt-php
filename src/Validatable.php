<?php namespace Paymennt;

/**
* Validatable class
*
* Class representing a purchase / invoice line item
*
* @author bashar
*/
abstract class Validatable {
  private const REGEX_AMOUNT = "/^([0-9]+\.?[0-9]{0,2}|\.[0-9]{1,2})$/";
  private const REGEX_NUMBER = "/^[0-9]+\.?[0-9]{0,2}|\.[0-9]{1,4}$/";
  private const REGEX_WHOLE_NUM = "/^\d+$/";
  PRIVATE CONST REGEX_COUNTRY_CODE = '/^[a-zA-Z]{2,3}$/';
  /**
  * Validates instasnce values. Throws exception if invalid
  */
  abstract public function validate();

  /**
  * Single parameter validation
  */
  protected function validateNullEmpty($param) {
    if (!isset($this->{$param}) || trim($this->{$param}) === '') {
      throw new Exception($param . " cannot be null or empty: '". $this->{$param} . "'");
    }
  }

  /**
  * Amount validation
  */
  protected function validateAmount($param) {
    if (preg_match(Validatable::REGEX_AMOUNT, $this->{$param}) !== 1) {
      throw new Exception("'".$this->{$param}."' is not a valid amount. must be a decimal with a maximum of 2 decimal digits");
    }
  }

  /**
  * Amount validation
  */
  protected function validateNumber($param) {
    if (preg_match(Validatable::REGEX_NUMBER, $this->{$param}) !== 1) {
      throw new Exception("'".$this->{$param}."' is not a valid number. must be a decimal with a maximum of 4 decimal digits");
    }
  }

  /**
  * Email validation
  */
  protected function validateEmail($param) {
    if (filter_var($this->{$param}, FILTER_VALIDATE_EMAIL) === FALSE) {
      throw new Exception("'" . $this->{$param} . "' is not a valid email address");
    }
  }

  /**
  * Whole number validation
  */
  public function validateWholeNumber($param) {
    if (preg_match(Validatable::REGEX_WHOLE_NUM, $this->{$param}) !== 1) {
      throw new Exception("'".$this->{$param}."' is not a valid number");
    }
    return true;
  }
  protected function validateCurrencyCode($param) {
    if (preg_match(Validatable::REGEX_COUNTRY_CODE, $this->{$param}) !== 1) {
      throw new Exception("currency code must be a 2 or 3 digit ISO code and non empty.");
    }
  }
}