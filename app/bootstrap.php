<?php
    //load configuration files
    require_once 'config/config.php';
    //load session helper
    require_once 'helpers/session_helper.php';
    //load url helper 
    require_once 'helpers/url_helper.php';

    // load library files
    /* require_once 'libraries/Controller.php';
    require_once 'libraries/Core.php';
    require_once 'libraries/Database.php'; */

    //autoload core libraries
    spl_autoload_register(function($className){ 
        require_once 'libraries/'. $className . '.php';
    });
    
