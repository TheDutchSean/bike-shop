<?php 

    class Bicycle {

        // constants
        public const CATEGORIES = ['Road','Mountain','Cruiser','City','BMX','E-Bike'];
        public const GENDER = ['men','woman','unisex'];
        protected const CONDITION_OPTIONS = [1 => 'Beat up', 2 => 'Decent',3 => 'Good', 4 => 'Great', 5 => 'Like New'];

        // public properties
        public $brand;
        public $model;
        public $year;
        public $category;
        public $color;
        public $description = 'Used bicycle';
        public $gender;


        // protected properties
        protected $weight_kg;
        protected $price;
        protected $condition_id;

        // private properties


        // methodes
        public function __construct($args=[]) {

            $reflectionClass = new ReflectionClass($this);
  
            foreach($args as $key => $value){
                if($reflectionClass->hasProperty($key) || $reflectionClass->hasMethod($key)){
                    if($reflectionClass->hasMethod($key)){
                        $this -> $key($value);
                    }
                    else{
                        if($reflectionClass->hasProperty($key)) {
                            $property = $reflectionClass->getProperty($key);
                            if(!$property -> isPrivate() && !$property -> isProtected()){
                                $this -> $key = $value ?? NULL;
                            }
                        }
                    }  
                }    
            }
        }

        public function name(){
            return $this -> brand . " ". $this -> model . " (" . $this -> year.")";
        }

        public function get_weight(){
            return round(floatval($this -> weight_kg),3)." kg";
        }

        public function set_weight($value){
            if(floatval($value) > 0){
                $this -> weight_kg = floatval($value);
            } 
        }

        public function get_weight_lbs(){
            return round(floatval($this -> weight_kg) * 2.20462262185, 3)." lbs";
        }

        public function set_weight_lbs($value){
            if(floatval($value) > 0){
                $this -> weight_kg = floatval($value) / 2.20462262185;
            }
        }

        public function get_condition(){
            return self::CONDITION_OPTIONS[$this->condition_id];
        }

        public function set_condition($value){
            $this->condition_id = $value; 
        }

        public function set_catergory($value){
            $this->category = self::CATEGORIES[$value]; 
        }

        public function set_gender($value){
            if($value >= 0 && $value <= 2){
                $this->gender = self::GENDER[$value];
            }       
        }

        public function get_price(){
            return "$".substr($this->price,0,-2).",".substr($this->price,-2,2);          
        }

        public function set_price($value){
            $this->price = str_replace(",","",str_replace("$", "", $value));    
        }

    }

?>