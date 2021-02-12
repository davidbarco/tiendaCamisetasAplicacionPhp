<?php 



class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    /* conexion a base de datos */
    private $db;

    public function __construct(){
       $this->db =  Database::connect();
    }

    
    
    public function getId()
    {
        return $this->id;
    }

   
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

   
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    
    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    
    public function getProvincia()
    {
        return $this->provincia;
    }

    
    public function setProvincia($provincia)
    {
        $this->provincia = $this->db->real_escape_string($provincia);

        return $this;
    }

    
    public function getLocalidad()
    {
        return $this->localidad;
    }

    
    public function setLocalidad($localidad)
    {
        $this->localidad = $this->db->real_escape_string($localidad);

        return $this;
    }

    
    public function getDireccion()
    {
        return $this->direccion;
    }

    
    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);

        return $this;
    }

   
    public function getCoste()
    {
        return $this->coste;
    }

   
    public function setCoste($coste)
    {
        $this->coste = $coste;

        return $this;
    }

    
    public function getEstado()
    {
        return $this->estado;
    }

   
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

     
    public function getFecha()
    {
        return $this->fecha;
    }

   
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

   
    public function getHora()
    {
        return $this->hora;
    }

    
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }
    
    
    /* metodo para listar todos los productos */
    public function getAll(){
        $sql= "SELECT * FROM pedidos ORDER BY id DESC;";
        $productos= $this->db->query($sql);
 
        return $productos;
    }

    /* metodo para cuando estamos editando, me saque la informacion de un producto en el formulario de editar */
    public function getOne(){
        $sql= "SELECT * FROM pedidos WHERE id ={$this->getId()};";
        $producto= $this->db->query($sql);
        
        return $producto->fetch_object();
        
    }
    
    
    /* metodo para guardar productos desde el formulario de crear */
  public function save(){

   /* codigo para insertar pedidos en la base de datos, debemos de ingresarlos de acuerdo al orden del modelo, es decir, primero el id, segundo el provincia y asi sucesivamente
   los que sean tipo de datos float o numeros, no necesitan estar entre comillas.   CON curdate saco la fecha, y con curtime saco la hora */
   
   $sql  = "INSERT INTO pedidos VALUES(NULL,'{$this->getUsuario_id()}','{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',CURDATE(),CURTIME())";
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


  /* metodo para relacionar lineas pedidos, que relaciona los productos con los pedidos */
  public function save_linea(){

    /* consulta sql , para sacar el ultimo insert que haya hecho de pedidos */
    $sql = "SELECT LAST_INSERT_ID() as 'pedido';";

    $query = $this->db->query($sql);
    $pedido_id = $query->fetch_object()->pedido;

        foreach ($_SESSION["carrito"] as  $elemento){

             $producto = $elemento["producto"];
             $insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id},{$producto->id},{$elemento['unidades']})";
             
             $save =$this->db->query($insert);
        }


        $result = false;
        if($save){
            $result= true;
        }
        return $result;


        /* para visualizar posible errores de la consulta sql */
        /* echo $this->db->error;
        die(); */


  }

  /* metodo para sacar el ultimo pedido del usuario */
  public function getOneByUser(){
    $sql= "SELECT p.id, p.coste FROM pedidos p " 
    . "WHERE p.usuario_id ={$this->getUsuario_id()} ORDER BY id DESC LIMIT 1;";
    $pedido= $this->db->query($sql);
    
    return $pedido->fetch_object();
    
}
   

  /*metodo para sacar productos por pedido */
  public function getProductosByPedido($id){

    /* $sql = "SELECT * FROM productos WHERE id IN "
            . "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id ={$id})"; */

   

    $sql =  "SELECT pr.*, lp.unidades FROM productos pr "
             . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
             . "WHERE lp.pedido_id={$id}";       
            $productos= $this->db->query($sql);
    
            return $productos;


  }


  /* metodo para sacar todos los pedidos de un  usuario en especifico */
  public function getAllByUser(){

    /* consulta sql para mostrar todos los pedidos de un usuario en especifico */
    $sql= "SELECT p.* FROM pedidos p " 
    . "WHERE p.usuario_id ={$this->getUsuario_id()} ORDER BY id DESC;";
    $pedido= $this->db->query($sql);
    
    return $pedido;
    
}


    /* metodo para editar un pedido, para editar el estado del pedido */
    public function edit(){

        /* codigo para insertar productos en la base de datos, debemos de ingresarlos de acuerdo al orden del modelo, es decir, primero el id, segundo el nombre y asisucesivamente */
        /* en los insert, el precio ni el stock , va entre comillas. */
        $sql  = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
        $sql .= " WHERE id ={$this->getId()};";

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


    

}










?>