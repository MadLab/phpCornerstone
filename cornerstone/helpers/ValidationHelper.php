<?php

class ValidationHelper{

   /**
    * Validation function to determine if a given string is a valid URL
    *
    * @static isUrl
    *
    * @param string $url The URL to validate
    *
    * @return boolean True if valid Url, False otherwise
    */
   public static function isUrl($url){
      return filter_var($url, FILTER_VALIDATE_URL);
   }

   /**
    * Validation function to determine if a given string is a well formed email address
    *
    * @static isEmail
    *
    * @param string $email The email address to validate
    *
    * @return boolean True if well formed email address, False otherwise
    */
   public static function isEmail($email){
      return filter_var($email, FILTER_VALIDATE_EMAIL);
   }

   /**
    * Validation function to determine if a given string is a valid date
    * @static isDate
    *
    * @param string $date The date to validate
    *
    * @return boolean True if valid date, False otherwise
    */
   public static function isDate($date){
      $timestamp = strtotime($date);
      if(!is_numeric($timestamp)){
         return false;
      }
      $month = date('m', $timestamp);
      $day = date('d', $timestamp);
      $year = date('Y', $timestamp);
      if(checkdate($month, $day, $year)){
         return true;
      }
      return false;
   }
}