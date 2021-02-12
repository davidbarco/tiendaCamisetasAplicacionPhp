
        <!-- contenido central -->
      
        <h1 class="destacado">Algunos de nuestros productos</h1>

            <!-- bucle para mostrar los objetos productos -->
            <?php while($produc = $productos->fetch_object()) : ?>
             <div class="product">
                 
                 
                    <div class="foto">
                        <!-- en caso de que el producto no tenga imagen, hacemos un if para colocar una imagen por defecto, solo en ese caso -->
                        <?php if($produc->imagen) : ?>
                        <img src="<?=base_url?>uploads/images/<?=$produc->imagen?>" alt="Camiseta">
                        <?php else: ?>
                            <img src="<?=base_url?>assets/img/default.png" alt="Camiseta">
                        <?php endif; ?>
                    </div>
                    

                 <div class="texto">
                     <h2><?=$produc->nombre?></h2>
                     <p>$<?=$produc->precio?> Dolares </p>
                     <a href="<?=base_url?>carrito/add&id=<?=$produc->id?>" class="button"><i class="fas fa-shopping-cart"> </i>Comprar</a>
                     <a class="button" href="<?=base_url?>producto/ver&id=<?=$produc->id?>"><i class="fas fa-angle-double-right"></i>Ver Producto</a>
                 </div>
             </div>
             <?php endwhile; ?>

             
          
        </div>

    