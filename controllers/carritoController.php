<?php 
require_once "models/producto.php";


class CarritoController{

    public function index(){
        /* var_dump($_SESSION["carrito"]); */
        
        if(isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) >= 1){
            
            $carrito = $_SESSION["carrito"];

        }else{
            $carrito = array();
        }

        /* vista para ver los productos seleccionados a comprar del carrito */
        require_once "views/carrito/index.php";
    }
    
    /* para añadir productos al carrito */
    public function add(){
        /* recogemos el parametro de la url con el id del producto, en el href del boton comprar le paso el parametro id */
        if(isset($_GET["id"])){
            $producto_id = $_GET["id"];
        }else{
            header("Location:".base_url);
        }

        /* creamos la sesion del carrito */
        if(isset($_SESSION["carrito"])){
            /* contador */
            $counter = 0;

            /* ciclo para saber si el producto que estoy comprando lo quiero comprar varias veces,entonces las unidades van sumando */
            foreach($_SESSION["carrito"] as $indice => $elemento){
                   if($elemento["id_producto"]== $producto_id){
                      
                    /* sumo uno a unidades cada vez que suceda */
                    $_SESSION["carrito"][$indice]["unidades"]++;
                    $counter++;
                   }
            }

        }

        if(!isset($counter) || $counter == 0){
                /* conseguir producto, cargamos el modelo arriba linea 2 */
                $producto = new Producto();
                $producto->setId($producto_id);
                $producto = $producto->getOne();
                
            
                /* pasarle los datos del objeto producto al carrito */
                /* añadir al carrito */
                if(is_object($producto)){
                    $_SESSION["carrito"][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto

                    );
                }
        }
        
        header("Location:".base_url."carrito/index");
    }

    /* para remover o quitar productos del carrito */
    public function remove(){
        /* si me llega por la url get el index */
        if(isset($_GET["index"])){
            $index = $_GET["index"];
            unset($_SESSION["carrito"][$index]);
        }

        header("Location:".base_url."carrito/index");
    }

    /* para eliminar productos del carrito */
    public  function delete_all(){
       unset($_SESSION["carrito"]);
       header("Location:".base_url."carrito/index");
    }


    /* metodo para aumentar cantidad de productos en el carrito, boton de +  */
    public function up(){
        if(isset($_GET["index"])){
            $index = $_GET["index"];
            $_SESSION["carrito"][$index]["unidades"]++;
        }
        header("Location:".base_url."carrito/index");
    }

      /* metodo para disminuir cantidad de productos en el carrito, boton de menos  " - " */

      public function down(){
          
        if(isset($_GET["index"])){
            $index = $_GET["index"];
            $_SESSION["carrito"][$index]["unidades"]--;

            /* si al restar las unidades llegan a cero, entonces */
            if($_SESSION["carrito"][$index]["unidades"]== 0){
                unset($_SESSION["carrito"][$index]);
            }
        }
        header("Location:".base_url."carrito/index");
    }



    














}



?>