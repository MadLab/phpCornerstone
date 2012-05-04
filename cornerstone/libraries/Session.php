<?

class Session{

   public function __construct(){
      session_start();
      $_SESSION['exists'] = true;
   }

   /**
    * Retrieve data from session
    *
    * @param string $key Key of value to return
    *
    * @return mixed Value
    */
   public function get($key){
      return $_SESSION['data'][$key];
   }

   /**
    * Add data to session
    *
    * @param string $key Key to store data at
    * @param mixed $value The data to store
    */
   public function set($key, $value){
      $_SESSION['data'][$key] = $value;
   }

   /**
    * Remove data from session
    *
    * @param string $key Key of data to remove
    */
   public function remove($key){
      unset($_SESSION['data'][$key]);
   }

   /**
    * Destroys the PHP Session
    */
   public function killSession(){
      session_destroy();
   }
}
