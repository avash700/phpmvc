<?php
    class Users extends Controller{
        public function __construct(){
            //load user model here
            $this->userModel = $this->model('User') ;
        }

        //default method 
        public function index(){
            
        }

        
        public function login(){

            //check is data is being posted
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process login request
                //sanitize post data
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                //init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),  
                    'email_err' => '',
                    'password_err' => ''
                ];

                //validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Email cannot be empty';
                }

                //validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Password cannot be empty'; 
                }

                //check if the email exists
                if($this->userModel->findUserByEmail($data['email'])){
                    //user found , do nothing
                }else{
                    //set error message
                    $data['email_err'] = 'User not found';
                }

                //confirm all error messages are empty
                if(empty($data['email_err']) && empty($data['password_err'])){
                    //validated
                    //check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'] , $data['password']);
                    if($loggedInUser){
                        //create session for the user
                        $this->createUserSession($loggedInUser);

                    }else{
                        //set error message and load the view with error messages
                        $data['password_err'] = 'Password incorrect' ;
                        $this->view('users/login' , $data);
                    }
                    

                }else{
                    //load view with error messages
                    $this->view('users/login' , $data);
                }

                
            }else{
                //init data
                $data = [
                    
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                    
                ];

            //load the login view
            $this->view('users/login' , $data);
            }
        }
 

        public function register(){
            //check id data is being posted
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process register request

                //sanitize post data
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

                //init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                //validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Email cannot be empty'; 
                }else{
                    if(!filter_var($data['email'] , FILTER_VALIDATE_EMAIL)){
                        $data['email_err'] = 'Enter email in the correct form' ; 
                    }else{
                        //check if email already exists
                        if($this->userModel->findUserByEmail($data['email'])){
                            $data['email_err'] = 'Entered email is already registerd';
                        }
                    }
                }

                //validate full name
                if(empty($data['name'])){
                    $data['name_err'] = 'Full Name cannot be empty'; 
                }else{ 
                    //validation for full name incomplete
                    $pattern = '/^[A-Za-z\x{00C0}-\x{00FF}][A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}][A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u' ;
                    if(!preg_match($pattern , $data['name'])){
                        $data['name_err'] = 'Only use alphabets and white space. E.g. John Doe';  
                    }
                }

                //validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password' ;

                }else{
                    if(strlen($data['password']) < 5) {
                        $data['password_err'] = 'Password must be atleast 5 characters.' ;
                    }
                }

                //validate confirm password
                if(empty($data['password'])){
                    $data['confirm_password_err'] = 'Please confirm password' ;

                }else{
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = 'Passwords do not match' ;
                    }
                }

                //confirm all error messages are empty
                if(empty($data['name_err']) && empty($data['eamil_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){

                    //validated
                    //hash password before storing
                    $data['password'] = password_hash($data['password'] , PASSWORD_DEFAULT);
                    //register user in the database
                    if($this->userModel->register($data)){
                        //if error free
                        redirect('users/login');

                    }else{
                        die('something went wrong!');
                    }
                    

                }else{
                    //load view with error messages
                    $this->view('users/register' , $data);
                }


            }else{
                //init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                //load the register view
                $this->view('users/register' , $data);

            }
        }

        //set session variables if the user successfully logs in
        public function createUserSession($data){
            $_SESSION['user_id'] = $data->id ;
            $_SESSION['user_name'] = $data->full_name ;
            $_SESSION['user_email'] = $data->email ;
            redirect('pages/index');
        }
        
        //logout the currrent user
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            session_destroy();
            redirect('users/login');
        }

       

}