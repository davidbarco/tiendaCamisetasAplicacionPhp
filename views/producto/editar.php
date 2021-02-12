<h1 class="tituloCrear">Editar el producto llamado: <?=$pro->nombre?></h1>

<!-- nota: en los input, el nombre que está dentro de el atributo name,
hace referencia a la variable que recogo por post. ejemplo:  con el $_post "nombre"  -->

<form class="crearCategoria" action="<?=base_url?>producto/save&id=<?=$pro->id?>" method="POST" enctype="multipart/form-data">
     
    <label for="nombre">Nombre</label><br>
    <input value="<?=$pro->nombre?>" class="email" type="text" name="nombre" required> <br>

    <label for="descripcion">Descripcion</label><br>
    <textarea class="email" name="descripcion" id="" cols="30" rows="2" required><?=$pro->descripcion?></textarea> <br>

    <label for="precio">Precio</label><br>
    <input value="<?=$pro->precio?>" class="email" type="text" name="precio" required> <br>

    <label for="stock">Stock</label><br>
    <input value="<?=$pro->stock?>" class="email" type="number" name="stock" required> <br>

    <label for="categoria">Categoria</label><br>

    <!-- utilizo el helpers utils, funcion showCategorias -->
    <?php $categorias = Utils::showCategorias(); ?>
    <select class="email" name="categoria" id="">
    <!-- aquí dentro debo mostrar las categorias que hayan en mi base de datos -->
    <?php while($cat = $categorias->fetch_object()) : ?>
                    
                    <!-- en el value del option, coloco el id de la categoria -->
                   <option value="<?=$cat->id?>" <?=$cat->id == $pro->categoria_id ? 'selected' : '';?>> <?=$cat->nombre?></option>
    
                  <?php endwhile; ?>
    
    
    </select> <br>

    <label for="imagen">Imagen</label><br>
    <!-- para mostrar la imagen -->
    <?php if(!empty($pro->imagen)) : ?>
      <img class="thumb" src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="">
    <?php endif; ?>
    <input class="email" type="file" name="imagen"> <br>

    <input class="enviar" type="submit" value="Crear">
</form>
