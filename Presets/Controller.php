<?php
class ControllerName extends Controller {

    function __construct()
    {
        parent::__construct();
    }

    function render(){
        $this->view->render("*ViewName*");
    }
}
?>