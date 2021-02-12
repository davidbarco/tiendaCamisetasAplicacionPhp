<?php 

/* importo mi modelo de pedido.php, para utilizar los metodos que tiene la clase */
require_once "models/pedido.php";

class pedidoController{

    public function hacer(){
        
        require_once "views/pedido/hacer.php";
    }


    /* metodo para ir al formulario y completar datos para hacer el pedido */
    public function add(){

        /* cuando guarde los datos en post. */

        /* 1 verifico si estoy identificado */
        if(isset($_SESSION["identity"])){

           /* aqui objento el id del usuario que está logueado */
           $usuario_id = $_SESSION["identity"]->id;

           /* aqui obtengo el coste */
           $stats = Utils::statsCarrito();
           $coste = $stats["total"];
           

          
            /* verifico si existen los datos por post de cada uno del formulario */
            $provincia = isset($_POST["provincia"]) ? $_POST["provincia"] : false;
            $localidad = isset($_POST["localidad"]) ? $_POST["localidad"] : false;
            $direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : false;
           
            if($provincia && $localidad && $direccion){
                /* si existe la sesion de identificado, guardaré el pedido */
                /* guardar datos en base de datos */
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                /* guardo todos mis datos en el metodo save del modelo pedido.php */
                $save = $pedido->save();

                /* guardar lina pedido */
                $save_linea= $pedido->save_linea(); 
                /* compruebo si el pedido se ha guardado correctamente */
                if($save && $save_linea){
                    $_SESSION["pedido"] = "complete";
                }else{
                    $_SESSION["pedido"] = "failed";
                }
               
            }else{
                $_SESSION["pedido"] = "failed";
            }

             /* redirigir al index */
             header("Location:".base_url."pedido/confirmado");
            
        }else{
            /* redirigir al index */
            header("Location:".base_url);
        }
    }

    /* metodo para pedido confirmado  */
    public function confirmado(){

        if(isset($_SESSION["identity"])){

             $identity = $_SESSION["identity"];
             $pedido = new Pedido();
             $pedido->setUsuario_id($identity->id);
              
             $pedido= $pedido->getOneByUser();

             $pedido_productos= new Pedido();
             $productos = $pedido_productos = $pedido_productos->getProductosByPedido($pedido->id);


        }
          /* despues de confirmar el pedido, se borra los pedidos que hay en el carrito */
        if(isset($_SESSION['carrito'])){
            Utils::deleteSession('carrito');
        }


        require_once "views/pedido/confirmado.php";
    }


    /* metodo para mis pedidos */
    public function mis_pedidos(){
         
        /* solo puedo acceder a este metodo si hay un usuario logueado */
        Utils::isIdentity();
        /* saco el id del usuario identificado */
        $usuario_id = $_SESSION["identity"];
       
        /* creo mi objeto */
        $pedido = new Pedido();

        /* sacar los pedidos del usuario */
        $pedido->setUsuario_id($usuario_id->id);
        $pedidos=  $pedido->getAllByUser();
        /* var_dump($pedidos); */
        

        require_once "views/pedido/mis_pedidos.php";
    }


    /* metodo para el detalle de mis pedidos */
    public function detalle(){
         /* solo puedo acceder a este metodo si hay un usuario logueado */
         Utils::isIdentity();

         /* recogo por la url el id del pedido */
         if(isset($_GET["id"])){
            $id= $_GET["id"];

            /* sacar los datos del pedido */
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido= $pedido->getOne();
            
            /* sacar los productos */
            $pedido_productos= new Pedido();
            $productos = $pedido_productos = $pedido_productos->getProductosByPedido($id);

            /* creo una vista */
            
           require_once "views/pedido/detalle.php";


         }else{
             header("Location:".base_url.'pedido/mis_pedidos');
         }



    }


    /* metodo para gestionar pedidos, sacar todos los pedidos */
    public function gestion(){
        /* compruebo si es usuario administrador */
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();


         /* creo una vista */
            
         require_once "views/pedido/mis_pedidos.php";
    }


    /* metodo para cambiar estado del pedido */
    public function estado(){
         /* compruebo si es usuario administrador */
         Utils::isAdmin();

         /* compruebo si me llega algo por el formulario de cambio de estado */
         if(isset($_POST["pedido_id"]) && isset($_POST["estado"])){
            /* recoger datos del formulario de cambio de estado */
            $id = $_POST["pedido_id"];
            $estado = $_POST["estado"];


           /* update del pedido */
           $pedido = new Pedido();
           $pedido->setId($id);
           $pedido->setEstado($estado);
           $pedido->edit();
 
           /* redirigir */
           header("Location:".base_url.'pedido/detalle&id='.$id);


         }else{
             header("Location:".base_url);
         }
    }
}



?>