<?php 



class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    /* conexion a base de datos */
    private $db;

    public function __construct(){
       $this->db =  Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getCategoria_id(){
        return $this->categoria_id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    function getPrecio(){
        return $this->precio;
    }
    function getStock(){
        return $this->stock;
    }
    function getOferta(){
        return $this->oferta;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getImagen(){
        return $this->imagen;
    }

    function setId($id){
        $this->id = $id;
    }
    function setCategoria_id($categoria_id){
        $this->categoria_id = $categoria_id;
    }

    /* escapo los datos con el metodo real_escape string, el cual me ayuda para cuando cree un producto desde el formulario, esos datos no se metan con comillas o simbolos raros, lo hago en los set  */
    function setNombre($nombre){
        $this->nombre =  $this->db->real_escape_string($nombre);
    }
    function setDescripcion($descripcion){
        $this->descripcion =  $this->db->real_escape_string($descripcion);
    }
    function setPrecio($precio){
        $this->precio =  $this->db->real_escape_string($precio);
    }
    function setStock($stock){
        $this->stock =  $this->db->real_escape_string($stock);
    }
    function setOferta($oferta){
        $this->oferta =  $this->db->real_escape_string($oferta);
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setImagen($imagen){
        $this->imagen = $imagen;
    }


    /* metodo para listar todos los productos */
    public function getAll(){
        $sql= "SELECT * FROM productos ORDER BY id DESC;";
        $productos= $this->db->query($sql);
 
        return $productos;
    }

     /* metodo para guardar productos desde el formulario de crear */
   public function save(){

    /* codigo para insertar productos en la base de datos, debemos de ingresarlos de acuerdo al orden del modelo, es decir, primero el id, segundo el nombre y asisucesivamente */
    /* en los insert, el precio ni el stock , va entre comillas. */
    $sql  = "INSERT INTO productos VALUES(NULL,'{$this->getCategoria_id()}','{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},NULL,CURDATE(),'{$this->getImagen()}')";
    $save = $this->db->query($sql);


    /* para visualizar posible errores de la consulta sql */
    /* echo $this->db->error;
    die(); */

    $result = false;
    if($save){
        $result= true;
    }
    return $result;


}

    /* metodo para borrar productos */
    public function delete(){


        $sql  = "DELETE FROM productos WHERE id ={$this->id};";
        $delete = $this->db->query($sql);
    
    
        /* para visualizar posible errores de la consulta sql */
        /* echo $this->db->error;
        die(); */
    
        $result = false;
        if($delete){
            $result= true;
        }
        return $result;
    }

    /* metodo para cuando estamos editando, me saque la informacion de un producto en el formulario de editar */
    public function getOne(){
        $sql= "SELECT * FROM productos WHERE id ={$this->getId()};";
        $producto= $this->db->query($sql);
 
        return $producto->fetch_object();

    }

    /* metodo para editar producto */
    public function edit(){

        /* codigo para insertar productos en la base de datos, debemos de ingresarlos de acuerdo al orden del modelo, es decir, primero el id, segundo el nombre y asisucesivamente */
        /* en los insert, el precio ni el stock , va entre comillas. */
        $sql  = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio = {$this->getPrecio()}, stock= {$this->getStock()}, categoria_id={$this->getCategoria_id()} ";
        
        
        /* condicion para comprobar si me llega la imagen cuando estoy editando el producto */
        if($this->getImagen() != null){
           
            $sql .= ", imagen='{$this->getImagen()}'";
        }
        
        
        $sql .= " WHERE id ={$this->id};";

        $save = $this->db->query($sql);
    
    
        /* para visualizar posible errores de la consulta sql */
        /* echo $this->db->error;
        die(); */
    
        $result = false;
        if($save){
            $result= true;
        }
        return $result;
    
    
    }


    /* metodo para listar los productos aleatorios en la pagina de inicio */
    public function getRandom($limit){

        /* Con esta consulta sql le digo que me liste todo de productos ordenado de forma aleatoria, con la consulta rand() y un limite de productos la cual le paso por parametro. */
        $sql= "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
        $productos= $this->db->query($sql);
 
        return $productos;


        /* luego llamo este metodo en el controlador de productos, en la funcion index */

    }

    /* metodo para listar todos los productos, pero por una categoria en concreta, esto lo estoy utilizando en el archivo ver.php por categoria */
    public function getAllCategory(){
   

        /* le pongo un alias a c.nombre clase 289 curso php minuto 14:30, */
        $sql= "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
        . "INNER JOIN categorias c ON c.id = p.categoria_id "
        . "WHERE p.categoria_id = {$this->getCategoria_id()} "
        . "ORDER BY id DESC";
        $productos= $this->db->query($sql);
 
        return $productos;
    }


}










?>