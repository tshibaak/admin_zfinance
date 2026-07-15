<?php 
  namespace App\controllers;
  class Controller
  {
    private static $controller;
    
    private static function instance():self{
        if(is_null(self::$controller))
        {
          self::$controller = new self();
        }
        return self::$controller;
    }
    
    protected function sanitize(string $input):string
    {
       return strip_tags(htmlspecialchars($input));
    }

     public static function status(int $status)
    {
      \http_response_code($status);
     return self::instance();
    }
    
   public static function json(array $array): void
   {
       header("Content-Type: application/json; charset=utf-8");
       echo json_encode($array);
       exit;
   }

    public function inputs(): array
   {
       $raw = file_get_contents('php://input');
       $datas = json_decode($raw, true);
   
       if (json_last_error() !== JSON_ERROR_NONE) {
           return [
               "status" => "error",
               "message" => "Corps de requête invalide"
           ];
       }
   
       return $datas;
   }

    public function create(){}
    public function delete(){}
    public function  index(){}
    public function update(){}
  }
?>
