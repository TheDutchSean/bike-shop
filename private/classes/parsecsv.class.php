<?php 

    class ParseCSV {

        private static $filename;
        public static $delimiter = ',';
        private static $header;
        private static $data=[];
        private static $row_count = 0;

        public function __construct($filename = "", $delimiter = ','){
            static::file($filename);
        }

        public static function file($filename = ""){

            if($filename == ""){
                return false;
            }
            else if(!file_exists($filename)){
                return false;
            }
            else if(!is_readable($filename)){
                return false;
            }

            static::$filename = $filename;
            
            return true;
        }

        public static function parse($filename = ""){
            
            static::reset();

            $valid_file = true;

            if($filename != ""){
                $valid_file = static::file($filename);
            }      

            if(!$valid_file){
                return static::$data;
            }

            $file = fopen(static::$filename, 'r');
    
            while(!feof($file)){
              $row =  fgetcsv($file, 0, static::$delimiter);
              if($row == [NULL] || $row === false){continue;}
                if(!static::$header){
                  foreach($row as $value){
                    static::$header[$value] = array_search($value, $row);
                  }
                }
                else{           
    
                  $args = [
                    'brand' =>  $row[static::$header['brand']],
                    'model' =>  $row[static::$header['model']],
                    'year'  =>  $row[static::$header['year']],
                    'category' => $row[static::$header['category']],
                    'color' =>  $row[static::$header['color']],
                    // 'description' => $row[static::$header['description']],
                    'gender' => $row[static::$header['gender']],
                    'set_weight' => $row[static::$header['weight_kg']],
                    'set_price' => $row[static::$header['price']],
                    'set_condition' => $row[static::$header['condition_id']],
                  ];
                
                  static::$data[] = $args;
                  static::$row_count++;
                }
            }
            fclose($file);
            return static::$data;
        }

        public static function result(){
            return static::$data;  
        }

        public static function row_count(){
            return static::$row_count;    
        }

        public static function reset(){
            static::$header = NULL;  
            static::$data = [];  
            static::$row_count = 0;      
        }
    }






?>