<?php
class Controller {

    function __construct()
    {
        $this->view = new View();
    }


    function LoadModel($model){
        $ModelFile = 'Models/' . $model . '.php';
        if(file_exists($ModelFile)){
            require $ModelFile;
            $modelname = $model.'Model';
            $this->model = new $modelname;
        }
    }
}
?>