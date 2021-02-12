<h1 style="text-align: center;">Gestionar Categorias</h1>

<div class="crearbtn">
<a href="<?=base_url?>categoria/crear" class="btnSmall button">Crear Categoria</a>
</div>


<table class="table">
     
      <tr>
          <th>ID</th>
          <th>NOMBRE</th>
      
      </tr>
      
      
        <?php while ($cat = $categorias->fetch_object()) : ?>

          
        <tr> 
            <td> <?=$cat->id; ?></td>
            <td> <?=$cat->nombre; ?></td>
        </tr>
          
          
       
        <?php endwhile; ?>
</table>

