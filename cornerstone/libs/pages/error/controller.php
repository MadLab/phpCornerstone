<?php

class errorPage{

   private $args;

   public function get(){
      $message = $this->get_arg('message');
      ?>
   <html>
   <body>
   <h1>Error</h1>

   <p><?php echo $message;?></p>
   </body>
   </html>
   <?php

   }

   public function set_args($args){
      $this->args = $args;
   }

   private function get_arg($var){
      return $this->args[$var];
   }
}
