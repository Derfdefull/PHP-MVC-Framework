<?php
class View {


    function __construct()
    {
        
    }

    function render($Viewname){
        require 'Views/' . $Viewname . '/index.php';
    }
}
?>