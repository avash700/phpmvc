<?php
    // default class , //we can extend controller because we are actually in index.php then bootstrap.php 
    class Pages extends Controller{

        public function __construct(){

        }

        //default method
        public function index(){
            $data = [
                'title' => 'Welcome'
            ];

            $this->view('pages/index' , $data);
        }

        public function about(){
            $this->view('pages/about');
        }

    }