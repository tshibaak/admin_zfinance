<?php 
   namespace Helper\String;

   class Stringy 
   {
      public static function empty(string $str): bool
      {
        return $str !== "" ? true : false;
      }

      public static function filled(string $str):bool
      {
        return !self::empty($str);
      }

      public static function concate(string $first = " ",string $second = " "):string
      {
        return $first . $second;
      }

      public static function compare(string $first, string $second):bool
      {
        return $first === $second ? true : false;
      }

      public static function lengthError(string $str, int $min = 3,int $max = 8):bool
      {
        return strlen($str) < $min || strlen($str) > $max ? false : true;
      }
      
      public static function randUUID(int $length = 20):string
      {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
      }
   }
?>