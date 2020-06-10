<?php
class Login extends Controller {

    function __construct()
    {
        parent::__construct();
        $this->view->messageu = '';
        $this->view->messagei = '';
    }

    function render(){
        $this->view->render("Login");
    }
    

    function SignIn(){
        $this->render();
        if(isset($_POST["User"]) || isset($_POST["Pwd"])){
            if(filter_var($_POST["User"], FILTER_VALIDATE_EMAIL)){
                if($_POST["User"] == $this->Email && $_POST["Pwd"] == $this->Password){
                    header("location: " .constant('URL')."Home");
                }else{
                    echo '<script>swal("Contraseña o Correo Incorrectos", "Verifica tu informacion e intenta nuevamente.", "error");</script>';
                }
            }else{
                if($_POST["User"] == $this->UserCode && $_POST["Pwd"] == $this->Password){
                    header("location: ".constant('URL')."Home");
                 }else{
                    echo '<script>swal("Contraseña o Usuario Incorrectos", "Verifica tu informacion e intenta nuevamente.", "error");</script>';
                 }
            }
        }else{
            echo '<script>swal("Campos vacios", "ingresa tus datos e intenta nuevamente", "warrning");</script>';
        }
    }

    function SigOut($param){
        echo print_r($param);
    }
    
    function SignUp(){
        if(isset($_POST["User"]) || isset($_POST["Email"]) || isset($_POST["Pwd"])){
            if(filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)){
                if($this->model->SignUp(["User" =>$_POST["User"], "Pwd" => $_POST["Pwd"] ,"Email" =>$_POST["Email"]]) == true){
                    $this->view->messageu = $this->Message("Has sido registrado", "success");
                }else{
                    $this->view->messageu = $this->Message("Este usuario ya fue registrado, si has olvidado tu contraseña contactanos.", "warning");
                }
            }else{
                $this->view->messageu = $this->Message("El correo no tiene el formato correcto.", "warning");
            }
        }else{
            $this->view->messageu = $this->Message("Campos Vacios", "danger");
        }
        $this->render();
    }



    function Message($Text, $Type){
        return '
        <div class="alert alert-'.$Type. ' alert-dismissible fade show" role="alert">
        <strong>'.$Text.'</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
}
?>