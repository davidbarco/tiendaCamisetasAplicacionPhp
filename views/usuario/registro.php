

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == "complete" ): ?>

    <strong class="alert_green" style="text-align: center;
     background-color: green;
     color: white;">Registro completado correctamente</strong>


    <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == "failed"): ?>
      
        <strong class="alert_red" style=" text-align: center;
     background-color: red;
     color: white;">Registro fallido, Introduce bien los datos.</strong>

<?php endif; ?>

<?php utils::deleteSession('register'); ?>




   
   
    
    <form class="form" action="<?=base_url?>usuario/save" method="POST">
    <h1 class="registrarse">Registrarse</h1>
         <label class="labelRegistro" for="nombre">Nombre</label> <br>
         <input class="inputRegistro" type="text" name="nombre" id="" required> <br>
    
         <label class="labelRegistro" for="apellidos">Apellidos</label> <br>
         <input class="inputRegistro" type="text" name="apellidos" id="" required> <br>
    
         <label class="labelRegistro" for="email">Email</label>  <br>
         <input class="inputRegistro" type="email" name="email" id="" required> <br>
    
    
         <label class="labelRegistro" for="password">Contraseña</label> <br>
         <input class="inputRegistro" type="password" name="password" id="" required> <br>
    
          <input  class="btnRegistro" type="submit" value="Registrarse">
    </form>



