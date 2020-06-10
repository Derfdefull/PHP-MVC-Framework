<?php
require_once 'Controllers/Error.php';
class App {

    function __construct()
    {
        try{

            $action = isset($_GET['action']) ? $_GET['action']: null;

            if(empty($action[0])){
                require_once 'Controllers/Login.php';
                $Controller = new Login();
                $Controller->LoadModel("Login");
                $Controller->view->render("Login");
                return false;
            }

            $action = explode('/', $action);
            
            for ($i=0; $i < sizeof($action); $i++) { 
                if($action[$i] == ""){
                unset($action[$i]);
                }
            }

            $ControllerFile = 'Controllers/' . $action[0] . '.php';

            if(file_exists($ControllerFile)){
                
                require_once $ControllerFile;
                $Controller = new $action[0]();
                $Controller->LoadModel($action[0]); 
                $paramLenght = sizeof($action);

                if($paramLenght > 1){
                        if($paramLenght > 2){
                            $param = [];
                            $_SESSION['action'] = $action[1];
                            for ($i=2; $i < $paramLenght;$i++){
                                array_push($param,$action[$i]);
                            }
                            
                            if(method_exists($Controller, $action[1])){
                                $Controller->{$action[1]}($param);
                            }else{
                                $Controller = new Error404();  
                            }
                        } 
                        else{
                            if(method_exists($Controller, $action[1])){
                                $Controller->{$action[1]}();
                            }else{
                                $Controller = new Error404();  
                            }
                        }
                }
        }else
            $Controller = new Error404(); 

        }catch(ArgumentCountError $e){
            $Controller = new Error404(); 
        }    
    }
}
