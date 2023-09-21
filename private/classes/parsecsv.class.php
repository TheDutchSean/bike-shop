<?php 

    class ParseCSV {

        public $filename;
        private $header;
        private $data=[];

        public function __construct($filename = ""){
            if($filename != ""){
                $this -> filename = $filename;
            }
        }

        public static function parse($filename = ""){
            
            if($filename != ""){
                $this -> filename = $filename;
            }

            $data = [];
            $file = fopen($this -> filename, 'r');

            // $this -> header = false;
    
            while(!feof($file)){
              $row =  fgetcsv($file, 0, ',');
              if($row == [NULL] || $row === false){continue;}
                if(!$this -> header){
                  foreach($row as $value){
                    $this -> header[$value] = array_search($value, $row);
                  }
                }
                else{           
    
                  $args = [
                    'brand' =>  $row[$header['brand']],
                    'model' =>  $row[$header['model']],
                    'year'  =>  $row[$header['year']],
                    'category' => $row[$header['category']],
                    'color' =>  $row[$header['color']],
                    // 'description' => $row[$header['description']],
                    'gender' => $row[$header['gender']],
                    'set_weight' => $row[$header['weight_kg']],
                    'set_price' => $row[$header['price']],
                    'set_condition' => $row[$header['condition_id']],
                  ];
                
                  $this -> data[] = $args;
                }
            }
            fclose($file);
            return $this -> data;
        }
    }






?>