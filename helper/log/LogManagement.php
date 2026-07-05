<?php 
   namespace Helper\Log;
   class LogManagement 
   {
     
      public static  $instance ;
      private string $path;
      private array $colors = [];
      
      public function __construct()
      {
         $this->path = dirname(__DIR__, 2).DIRECTORY_SEPARATOR."logs";
         $this->colors = require dirname(__DIR__,2).DIRECTORY_SEPARATOR."config". DIRECTORY_SEPARATOR."log.php";

         if (!is_dir($this->path)) 
         {
            mkdir($this->path, 0777, true);
         }
      }
      
      private function create(string $content,string $file):void
      {  
          if(file_exists($this->path.DIRECTORY_SEPARATOR.$file))
          {
            file_put_contents( $this->path.DIRECTORY_SEPARATOR.$file, "[". $this->date()."] ".$content."\n", FILE_APPEND);
          }
   
      } 

      public function access(string $content):void
      {
         $this->create("{$this->colors['green']}[ACCESS]{$this->colors['reset']}". $content, "access.log");
      }

      public function error(string $content):void
      {
         $this->create("{$this->colors['red']}[ERROR]{$this->colors['reset']} ". $content, "error.log");  
      }

      public function date():string
      {
         return"". date('Y-m-d')." | ". $this->hour();
      }


      public function hour():string
      {
         return date('H:i:s');
      }

      public static function Instance():self
      {
         if(is_null(self::$instance))
         {    
            self::$instance = new self();
         }
         return self::$instance;
      }
   }

?>