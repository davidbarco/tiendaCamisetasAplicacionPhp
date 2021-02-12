<?php 

/* cargo mi modelo de categoria.php */
require_once 'models/producto.php';

class productoController{

    public function index(){
        $producto = new Producto();
        /* le paso por parametro, el limite de productos que quiero mostrar, en este caso es 6 , pero el numero puede varias al que yo quiera*/
        $productos = $producto->getRandom(5);
        /* var_dump($productos->fetch_object()); */
        /* renderizar vista */
        require_once "views/producto/destacados.php";
    }
    
    /* para listar todos los productos */
    public function gestion(){
         /* esta pagina solo accede el administrador, colocamos este metodo
         para saber si el rol de usuario es admin. */
         Utils::isAdmin();
         
         /* creo mi objeto */
         $producto = new Producto();
         
         /* despues de crear el objeto, llamo al metodo getAll que se encuentra en mi clase producto.php */
         $productos = $producto->getAll();

         require_once "views/producto/gestion.php";
    }

    /* funcion para crear productos, cargamos nuestra vista, funcion crear y funcion save van de la mano */
    public function crear(){
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }
    /* metodo para guardar un nuevo productos  nota: dentro de este metodo hay una condicion para cuando voy a enviar la informacion dede editar el producto. */
    public function save(){
        
        Utils::isAdmin();
         
        /* recogo los parametros del formulario de crear productos */
        if(isset($_POST)){
             
            $nombre= isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $descripcion= isset($_POST["descripcion"]) ?  $_POST["descripcion"] : false;
            $precio= isset($_POST["precio"]) ?  $_POST["precio"] : false;
            $stock= isset($_POST["stock"]) ?  $_POST["stock"] : false;
            $categoria= isset($_POST["categoria"]) ?  $_POST["categoria"] : false;

            /* condicion para saber si los parametros me estan llegando y son true */
            if($nombre && $descripcion && $precio && $stock && $categoria){
               
                /* guardar producto en base de datos */
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                /* guardar la imagen,subida del archivo.
                nota: importante en el formulario, colocar esto:  enctype="multipart/form-data" */
                if(isset($_FILES["imagen"])){

                    $file = $_FILES["imagen"];
                    $filename = $file["name"];
                    $mimetype = $file["type"];
                  
                    /* para comprobar que la imagen sea una extension correcta */
                    if($mimetype == "image/jpeg" || $mimetype ==  "image/jpg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                       
                        /* cuando la imagen sea correcta, en formato y todo, me creo una carpeta donde la puedo guardar */
                        if(!is_dir("uploads/images")){
                          
                          mkdir("uploads/images", 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                        $producto->setImagen($filename);
                    }
                }
                
                /* aqui empieza la condicion cuando voy a editar el producto */
                if(isset($_GET["id"])){
                    $id= $_GET["id"];
                    $producto->setId($id);
                    $save = $producto->edit();
                    /* fin de condicion si voy a editar */
                }else{
                    $save = $producto->save();
                }

                if($save){
                    $_SESSION["producto"] = "complete";
                }else{
                    $_SESSION["producto"] = "failed";   
                }
               
            }else{
                $_SESSION["producto"] = "failed";
            }


        }else{
            $_SESSION["producto"] = "failed";
        }

       /* redireccion al listado de los productos */
        header("Location:".base_url."producto/gestion");
        

    }

     
    /* metodo para eliminar un producto */
    public function eliminar(){
        Utils::isAdmin();

        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $producto = new Producto();
            $producto->setId($id);

            $delete= $producto->delete();
            if($delete){
               $_SESSION["delete"] = "complete";
            }else{
                $_SESSION["delete"] = "failed";
            }
        }else{
            $_SESSION["delete"] = "failed";
        }
        /* redireccion */
        header("Location:".base_url."producto/gestion");
    }

    /* metodo para editar un producto */
    public function editar(){
        Utils::isAdmin();
        if(isset($_GET["id"])){
            
            $id = $_GET["id"];
            $producto = new Producto();
            $producto->setId($id);
            $pro =$producto->getOne();
            /* incluimos una vista cuando le demos click */
            require_once "views/producto/editar.php";

        }else{
              /* redireccion */
        header("Location:".base_url."producto/gestion");
        }
    }

    /* metodo para ver un producto al detalle */
    public function ver(){

        if(isset($_GET["id"])){

            $id = $_GET["id"];

            $producto = new Producto();
            $producto->setId($id);

            $pro =$producto->getOne();
        
        }
        /* incluimos una vista cuando le demos click */
        require_once "views/producto/ver.php";
    }






}



?>