<?php 

class Categoria{

   private $id;
   private $nombre;
    /* conexion a base de datos */
   private $db;

   public function __construct(){
       $this->db =  Database::connect();
   }

   function getId(){
       return $this->id;
   }

   function getNombre(){
       return $this->nombre;
   }

   function setId($id){
    $this->id= $id;
   }

   function setNombre($nombre){
    $this->nombre= $this->db->real_escape_string($nombre);
   }


   /* metodo para mostrar todas las categorias */
   public function getAll(){
       $sql= "SELECT * FROM categorias ORDER BY id DESC;";
       $categorias= $this->db->query($sql);

       return $categorias;

   }


   /* metodo para guardar categoria desde el formulario de crear */
   public function save(){

         /* codigo para insertar usuario en la base de datos, el rol será fijo y será 'user' */
         $sql  = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre()}')";
         $save = $this->db->query($sql);
 
         $result = false;
         if($save){
             $result= true;
         }
         return $result;


   }

   /* metodo para mostrar una categoria en concreta desde la pagina ver.php */
   public function getOne(){
    $sql= "SELECT * FROM categorias WHERE id ={$this->getId()}";
    $categoria= $this->db->query($sql);

    return $categoria->fetch_object();
   }


}




?>