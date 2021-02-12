<h1 class="tituloCrear">Crear nueva categoria</h1>



<form class="crearCategoria" action="<?=base_url?>categoria/save" method="POST">
     
    <label for="nombre">Nombre</label><br>
    <input class="email" type="text" name="nombre" required> <br>

    <input class="enviar" type="submit" value="Crear">
</form>
