<?php 

/* cargo mi modelo de categoria.php */
require_once 'models/categoria.php';

/* cargo el modelo de productos, para en el metodo " ver "  poder mostrar todos los productos de cada categoria*/
require_once "models/producto.php";


class categoriaController{

    public function index(){
        Utils::isAdmin();

        /* llamo mi objeto para luego acceder al metodo get categorias */
        $categoria = new categoria();
        $categorias= $categoria->getAll();

        
        require_once 'views/categoria/index.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    
    
    /* metodo para guardar una nueva categoria */
    public function save(){
        
        Utils::isAdmin();
         
        if(isset($_POST) && isset($_POST["nombre"])){

            /* guardar categoria en base de datos */
            $categoria = new Categoria();
            $categoria->setNombre($_POST["nombre"]);
            $categoria->save();

        }



        header("Location:".base_url."categoria/index");
        ob_end_flush();

    }

    /* metodo para ver lo que tiene la categoria al darle click a cada categoria en el menú */
    public function ver(){

        if(isset($_GET["id"])){
            $id = ($_GET["id"]);

            /* conseguir la categoria */
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();

            /* luego de sacar la categoria, debo sacar todos los productos de esa categoria */
            /* conseguir productos */
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();





        }

        require_once "views/categoria/ver.php";
    }








}



?>