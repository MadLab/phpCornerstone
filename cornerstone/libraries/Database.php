<?php

class Database{

   private $_host;
   private $_user;
   private $_password;
   private $_dbname;
   private $_connection;
   private static $_instance;

   /**
    * Constructor initializes database PDO connection
    *
    * @param array $connectionParams array containing host, username, password, and database to connect to
    */
   public function __construct($connectionParams){
      $this->_host = $connectionParams['host'] ? $connectionParams['host'] : 'localhost';
      $this->_user = $connectionParams['user'];
      $this->_password = $connectionParams['password'];
      $this->_dbname = $connectionParams['dbname'];

      try{
         $this->_connection = new PDO("mysql:host={$this->_host};dbname={$this->_dbname}", $this->_user, $this->_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

         return true;
      }
      catch(PDOException $e){
         $cs = cs::getInstance();
         $cs->throwError($e->getMessage(), debug_backtrace(true));
         return false;
      }
   }

   /**
    * Retrieve a database connection with the given connection parameters. Will create connection if none exists
    * @static getConnection
    *
    * @param  array $connectionParams
    *
    * @return Database Database Instance
    */
   public static function getConnection($connectionParams){
      /*
        * Returns the last database connection if available,
         * otherwise initializes a new database connection
        */

      if(self::$_instance){
         return self::$_instance;
      }
      else{
         self::$_instance = new Database($connectionParams);
         return self::$_instance;
      }
   }

   /**
    * Queries database and returns number of affected rows. Used for any queries that insert/update info
    *
    * @param string $query The parameterized query to execute
    * @param array $params Array of parameters to fill query with
    *
    * @return bool|int The number of affected rows, or false on error
    */
   public function set($query, $params = array()){
      if(!is_array($params)){
         $params = array($params);
      }
      $params = array_values($params);
      try{
         $statement = $this->_connection->prepare($query);
         if($statement->execute($params)){
            return $statement->rowCount();
         }
         else{
            $cs = cs::getInstance();

            $e = $statement->errorInfo();
            $cs->throwError($e[2], debug_backtrace(true));
            return false;

         }

      }
      catch(PDOException $e){
         $cs = cs::getInstance();
         $cs->throwError($e->getMessage(), debug_backtrace(true));
         return false;
      }
   }

   /**
    * Queries database and returns the resulting data. Used for any queries that fetch data
    *
    * @param string $query The parameterized query to execute
    * @param array $params Array of parameters to fill query with
    *
    * @return boolean|array The resulting data, or false on error
    */
   public function get($query, $params = array()){
      try{
         $statement = $this->_connection->prepare($query);
         if(!is_array($params)){
            $params = array($params);
         }
         $statement->execute($params);
         return $statement->fetchAll(PDO::FETCH_BOTH);
      }
      catch(PDOException $e){
         $cs = cs::getInstance();
         throw new Exception($e->getMessage());
         return false;
      }
   }

   /**
    * Convenience function to return a single row when executing a 'get' style query. Used when fetching a single row.
    *
    * @param  string $query The parameterized query to execute
    * @param array $params Array of parameters to fill query with
    *
    * @return boolean|array Single row result, or false on error
    */
   public function getRow($query, $params = array()){
      $result = $this->get($query, $params);
      if(count($result) > 0){
         return $result[0];
      }
      return false;
   }

   /**
    * Convenience function to return a single value when executing a 'get' style query. Used when fetching a single values
    *
    * @param string $query The parameterized query to execute
    * @param array $params Array of parameters to fill query with
    *
    * @return string|boolean The value, or false on error
    */
   public function getValue($query, $params = array()){
      $result = $this->get($query, $params);
      if(count($result) > 0){
         return $result[0][0];
      }
      return false;
   }

   /**
    * Convenience function to format an update query
    *
    * @param string $table Table to update
    * @param array $fields Array of key=>value containing columns to update
    * @param array $conditions Array of key=>value containing conditions to match
    *
    * @return boolean|int Number of rows affected, or false on error
    */
   public function update($table, $fields, $conditions){
      $fieldList = array();
      $conditionList = array();
      $params = array();

      $query = "update $table set ";
      foreach((array)$fields as $field => $value){
         $fieldList[] = "`$field` = ?";
         $params[] = $value;
      }
      $query .= implode(", ", $fieldList);
      $query .= " where ";
      foreach((array)$conditions as $condition => $value){
         $conditionList[] = "$condition = ?";
         $params[] = $value;
      }
      $query .= implode(", ", $conditionList);

      return $this->set($query, $params);
   }

   /**
    * Convenience function to format an insert query
    *
    * @param array $table Table to insert into
    * @param array $fields Array of key=>value containing columns to insert into
    *
    * @return int The last insert ID
    */
   public function insert($table, $fields){
      $params = array();
      $fieldList = array();
      $valueList = array();

      foreach((array)$fields as $field => $value){
         $fieldList[] = "`" . $field . "`";
         $valueList[] = '?';
         $params[] = $value;
      }
      $fieldList = implode(",", $fieldList);
      $valueList = implode(",", $valueList);
      $query = "insert into $table($fieldList) values ($valueList)";
      $this->set($query, $params);

      return $this->_connection->lastInsertId();
   }
}
