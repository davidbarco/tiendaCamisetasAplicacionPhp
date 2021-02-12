
<?php
ob_start();

session_start();

require_once 'autoload.php';

require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once "views/layout/header.php";
require_once "views/layout/sidebar.php";

/* conexion a base de datos */
$db = Database::connect();

function show_error(){
    /* cuando la pagina que busco no existe, cargo el controlador error */
	$error= new errorController();
	$error->index();
}


if(isset($_GET['controller'])){
	$nombre_controlador = $_GET['controller'].'Controller';
}else if(!isset($_GET['controller'])&& !isset($_GET['action'])){
         
	$nombre_controlador = controller__default;
      
}else{
	show_error();
	exit();
}

if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];
		$controlador->$action();
	}else if(!isset($_GET['controller'])&& !isset($_GET['action'])){
        $action_default = action_default;
		$controlador->$action_default();
		  
	}else{
		show_error();
	}
}else{
	show_error();

}

require_once "views/layout/footer.php";

