<?php 

class Utils{
      
    public static function deleteSession($name){

          if(isset($_SESSION[$name])){

              $_SESSION[$name]= null;
              unset($_SESSION[$name]);

          }
          return $name;
         
    }

    /* funcion para saber si es administrador */
    public static function isAdmin(){
        if(!isset($_SESSION["admin"])){
            header("Location:".base_url);
        }else{
            return true;
        }

    }

    /* mostrar categorias en el menú. */
    /* luego me va a servir para mmostrar las categorias desde el formulario de crear productos */
    public static function showCategorias(){
        
        require_once 'models/categoria.php';

        /* llamo mi objeto para luego acceder al metodo get categorias */
        $categoria = new categoria();
        $categorias= $categoria->getAll();

        return $categorias;
    }


    /* funcion para ver la cantidad y total de productos en carrito */
    public static function statsCarrito(){
        $stats = array(
            "count" => 0,
            "total" => 0
        );
        if(isset($_SESSION["carrito"])){
            /* si existe la sesion*/
            $stats["count"]= count($_SESSION["carrito"]);


            /* para sacar el total de la compra */
            foreach($_SESSION["carrito"] as $producto ){

                /* total */
                $stats["total"] += $producto["precio"]*$producto["unidades"];

            }

        }
        return $stats;
    
    }


    /* funcion para saber si estamos identificados */
    public static function isIdentity(){
        if(!isset($_SESSION["identity"])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }


    /* metodo para saber el estado de los pedidos */
    public static function showStatus($status){
        $value = "pendiente";   
        if($status == "confirm"){
            $value = "pendiente";

        }elseif($status == "preparation"){
            $value = "en preparacion";
        }elseif($status == "ready"){
            $value = "Listo para envio";
        }elseif($status == "sended"){
            $value = "Enviado";
        }

        return $value;
    }

}




?>