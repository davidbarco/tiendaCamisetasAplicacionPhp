<?php 

/* cargo mi modelo usuario.php */
require_once 'models/usuario.php';



class usuarioController{

    public function index(){
        echo "Controlador usuarios, accion index";
    }

    /* metodo para registrar usuario */
    public function registro(){
        require_once "views/usuario/registro.php";
    }

    /* metodo para guardar usuario */
    public function save(){
        if(isset($_POST)){

             $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
             $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : false;
             $email = isset($_POST["email"]) ? $_POST["email"] : false;
             $password = isset($_POST["password"]) ? $_POST["password"] : false;



              if($nombre && $apellidos && $email && $password){
              
                $usuario= new Usuario();  
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                /* llamo al metodo que tengo en el modelo para guardar el usuario */
                $save= $usuario->save();
                /* condicion por si el metodo save falla */
                if($save){
                    /* cuando el registro esté correcto, abri una session */
                    $_SESSION['register']= "complete";
                }else{
                    $_SESSION['register']= "failed";    
                }
            }else{
                $_SESSION['register']= "failed";  
            }

        }else{
            $_SESSION['register']= "failed";   
        }
        /* para redirigir */
        header("Location:".base_url.'usuario/registro');
    }

    /* metodo para hacer login al usuario ya guardado */
    public function login(){

        if(isset($_POST)){
           
            /* identificar al usuario */
            /* consulta a la base de datos */
            $usuario = new Usuario();
            
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword($_POST["password"]);
            
            $identity = $usuario->login();
            

            if($identity && is_object($identity)){
                 
                $_SESSION["identity"]= $identity;

                if($identity->rol == "admin"){
                    var_dump($identity->rol);

                    $_SESSION["admin"] = true;
                }
            }else{
                $_SESSION["error_login"] = "identificacion fallida";
            }


            /* crear una sesion */
          
        }
        /* redireccion */
        header("Location:".base_url);

    }

    /* metodo para cerrar sesion */
    public function logout(){
        if(isset($_SESSION["identity"])){
           
            unset($_SESSION["identity"]);
        }

        if(isset($_SESSION["admin"])){
           
            unset($_SESSION["admin"]);
        }

        /* redireccionar, cuando me elimine la sesion del logueo */
        header("Location:".base_url);
    }



}



?>