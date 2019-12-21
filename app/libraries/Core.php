<?php

    /*
    *app core class
    *loads controllers from the url , creates url
    *url format - /controller/method/params
    */
    class Core{

        protected $currentController = 'Pages'; //default controller
        protected $currentMethod = 'index'; //default method
        protected $params = []; //default parameters are empty

        public function __construct(){
            //print_r($this->getUrl());
            
            $url = $this->getUrl();

            //look in controller for first value
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php' )){
            
                //if exists , set as controller
                $this->currentController = ucwords($url[0]);
        
                //removes 0 index coz its job is done
                unset($url[0]);
                
            }
            //require the controller , two dots because this is actually in public/index.php
            require_once '../app/controllers/'. $this->currentController . '.php' ;
           
            //! instantiate the controller class - this is important
            $this->currentController = new $this->currentController;

            //check for second part of the url
            if(isset($url[1])){
                //check if the method exists in current controller
                if(method_exists($this->currentController , $url[1])){
                    $this->currentMethod = $url[1];

                    //removes 1 index , its job is done
                    unset($url[1]);
                }
            }

            //print_r($url);

            //get params , if there are any 
            if($url){
                $this->params = array_values($url); //returns values of the array
            }else{
                $this->params = [];
            }

            //callback function , calls user defined function in a class with multiple params(array of params)
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params); 
            
                
        }
        
        public function getUrl(){
            // if url exists
            if(isset($_GET['url'])){
                // removes excess '/' from right side of url
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/' , $url); //stores in an array
                return $url;
            }
            
        }
    }