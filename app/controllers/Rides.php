<?php
    class Rides extends Controller{

        public function __construct(){
            //redirect to login page if not logged in
            if(!isLoggedIn()){
                redirect('users/login');
            }
            $this->rideModel = $this->model('Ride');
        }
        //default method for rides controller
        public function index(){

            //get posts
            $rides = $this->rideModel->getRides();
            $data = [
                'rides' => $rides
            ];
            $this->view('rides/index' , $data);
        }
    }