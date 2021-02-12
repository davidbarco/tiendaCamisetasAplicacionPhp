<h1 style="text-align: center;">Gestion de productos</h1>


<div class="crearbtn">  <!-- la url producto/crear, es cuando le de click al boton, me va a llevar al formulario para crear un nuevo producto -->
<a href="<?=base_url?>producto/crear" class="btnSmall button">Crear Producto</a>
</div>


<!-- si la sesion existe y la sesion es igual a complete, es decir, que si creamos un producto correctamente, entonces muestreme este mensaje -->
<?php if(isset($_SESSION["producto"]) && $_SESSION["producto"]== "complete") : ?>
 
    <strong class="alert_green" style="text-align: center;
     background-color: green;
     color: white;">Producto creado correctamente</strong>

<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] == "failed"): ?>
      
      <strong class="alert_red" style=" text-align: center;
   background-color: red;
   color: white;">Registro de producto incorrecto, Introduce bien los datos.</strong>

<?php endif; ?>

<?php utils::deleteSession('producto'); ?>

<!-- fin de la condicion del boton de mensaje correcto o incorrecto -->

<!-- -------------------------------------------------------------------- -->

<!-- si la sesion existe y la sesion es igual a complete, es decir, que si eliminamos un producto correctamente, entonces muestreme este mensaje -->
<?php if(isset($_SESSION["delete"]) && $_SESSION["delete"]== "complete") : ?>
 
 <strong class="alert_green" style="text-align: center;
  background-color: green;
  color: white;">Producto eliminado correctamente</strong>

<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] == "failed"): ?>
   
   <strong class="alert_red" style=" text-align: center;
background-color: red;
color: white;">borrado de producto incorrecto</strong>

<?php endif; ?>

<?php utils::deleteSession('delete'); ?>

<!-- fin de la condicion del boton de mensaje correcto o incorrecto -->



<table class="table">
     
      <tr>
          <th>ID</th>
          <th>NOMBRE</th>
          <th>PRECIOS</th>
          <th>STOCK</th>
          <th>ELIMINAR</th>
          <th>EDITAR</th>
      
      </tr>
      
      
        <?php while ($pro = $productos->fetch_object()) : ?>
              
          
        <tr> 
        <!-- con esto deberia de funcionar, verifica que en la base de datos 
        hayan productos para mostrar. -->
            <td> <?=$pro->id; ?></td>
            <td> <?=$pro->nombre; ?></td>
            <td> <?=$pro->precio; ?></td>
            <td> <?=$pro->stock; ?></td>
            
            <!-- botones de eliminar y editar, para saber que producto requiero eliminar, en el href le paso el dia del producto -->
            <td><a class="button red" style="color: white;" href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>">Eliminar</a></td>
            <td><a class="button orange" style="color: white;" href="<?=base_url?>producto/editar&id=<?=$pro->id?>">Editar</a></td>
        </tr>
          
          
       
        <?php endwhile; ?>
</table>