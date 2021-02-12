<?php 
/* modelo de usuario, coloco las propiedades de acuerdo a las mismas que 
coloqué en la base de datos */




class Usuario{
      private $id;
      private $nombre;
      private $apellidos;
      private $email;
      private $password;
      private $rol;
      private $imagen;
      /* conexion a base de datos */
      private $db;

      public function __construct(){
         $this->db =  Database::connect();
      }
      


      /* getter and setter */
    function getId(){
        return $this->id;
    }

      function getNombre(){   
        return $this->nombre;
    }

    function getApellidos(){
        return $this->apellidos;
    }

    function getEmail(){
        return $this->email;
    }

    function getPassword(){
        return  password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);
    }

    function getRol(){
        return $this->rol;
    }

    function getImagen(){
        return $this->imagen;
    }


    function setId($id){
        $this->id = $id;
    }
      function setNombre($nombre){

        /* escapo los datos que me lleguen por el formulario de registro */
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
     
    function setEmail($email){
         $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password){
         $this->password= $password;
    }

    function setRol($rol){
          $this->rol= $rol;
    }

    function setImagen($imagen){
          $this->imagen= $imagen;
    }



    /*1)  metodo save, para guardar un usuario */

    public function save(){
        /* codigo para insertar usuario en la base de datos, el rol será fijo y será 'user' */
        $sql  = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user',NULL)";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result= true;
        }
        return $result;
    }

    /* 2) metodo login, para entrar con un usuario ya previamente guardado */
    public function login(){

        $result = false;

        $email = $this->email;
        $password = $this->password;


        /* comprobar si existe el usuario */
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){

            $usuario = $login->fetch_object();

            /* verificar la contraseña */
            $verify = password_verify($password,$usuario->password);
           
            if($verify){
               $result= $usuario;
            }


        }
        return $result;
    }

    


      


       



}

?>