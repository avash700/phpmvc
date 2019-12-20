<?php

    /*
    *app core class
    *loads controllers from the url , creates url
    *url format - /controller/method/params
    */
    class Core{

        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            //print_r($this->getUrl());

            $url = $this->getUrl();

            //look in controller for first value
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php' )){
            
                //if exists , set as controller
                $this->currentController = ucwords($url[0]);
        
                //unset 0 index coz its job is done
                unset($url[0]);
                
            }
            //require the controller
            require_once '../app/controllers/'. $this->currentController . '.php' ;
           
            //! instantiate the controller class - this is important
            $this->currentController = new $this->currentController;
                
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