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
            $rides = $this->rideModel->getUserRides();
            $data = [
                'rides' => $rides
            ];
            $this->view('rides/index' , $data);
        }

      
  
        //add rides
        public function add(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                //process request to add ride
                //sanitize post data
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                $data = [
                    'source' => trim($_POST['source']),
                    'destination' => trim($_POST['destination']),
                    'departure' => trim($_POST['departure']),
                    'vehicle' => trim($_POST['vehicle']),
                    'seats' => trim($_POST['seats']),
                    'source_err' => '',
                    'destination_err' => '',
                    'departure_err' => '',
                    'vehicle_err' => '',
                    'seats_err' => '',
                    'add_success' => ''
                ];

                //validate source
                if(empty($data['source'])){
                    $data['source_err'] = 'Source cannot be empty';
                }

                //validate destination
                if(empty($data['destination'])){
                    $data['destination_err'] = 'Destination cannot be empty';
                }

                //validate departure
                if(empty($data['departure'])){
                    $data['departure_err'] = 'Departure cannot be empty';
                }

                //validate vehicle type
                if(empty($data['vehicle'])){
                    $data['vehicle_err'] = 'Vehicle cannot be empty';
                }

                //validate seats
                if(empty($data['seats'])){
                    $data['seats_err'] = 'Seats cannot be empty';
                }

                //check all errors are empty
                if(empty($data['source_err']) && empty($data['destination_err']) && empty($data['departure_err']) && empty($data['vehicle_err']) && empty($data['seats_err'])){

                    //insert the data
                    if($this->rideModel->addRide($data)){
                        redirect('rides');
                    }else{
                        die('something went wrong !!');
                    }

                }else{
                    //load view with the error messages
                    $this->view('rides/add',$data);
                }


            }else{
                //init data
                $data = [
                    'source' => '',
                    'destination' => '',
                    'departure' => '',
                    'vehicle' => '',
                    'seats' => '',
                    'source_err' => '',
                    'destination_err' => '',
                    'departure_err' => '',
                    'vehicle_err' => '',
                    'seats_err' => ''

                ];
                $this->view('rides/add',$data);
            }
            
        }
  
        public function delete($ride_id){
            if($this->rideModel->deleteRide($ride_id)){
                redirect('rides');
            }else{
                die('Something went wrong !!');
            }
            
        }

        public function update($ride_id){

            $user_ride_id = $this->rideModel->checkUserSession($ride_id);
            if($user_ride_id->user_id !== $_SESSION['user_id']){

                redirect('rides');
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                 //sanitize post data
                 $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
                
                 if($this->rideModel->updateRide($_POST)){
                    
                    redirect('rides');
                 }else{
                     die('Something went wrong!!'); 
                 }
                

            }else{
                $result = $this->rideModel->getRideById($ride_id);
                $data = [
                    'rideid' => $result->id,
                    'source' => $result->source,
                    'destination' => $result->destination,
                    'departure' => $result->departure,
                    'vehicle' => $result->vehicle,
                    'seats' => $result->seats,
                    'source_err' => '',
                    'destination_err' => '',
                    'departure_err' => '',
                    'vehicle_err' => '',
                    'seats_err' => ''
                ];
    
                $this->view('rides/update' , $data);
            }
        }

        
   
    }