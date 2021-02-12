<?php if(isset($pro)) : ?>

<h1 style="text-align: center;"><?=$pro->nombre?></h1>


             <div class="details-product">
                 
                 
                    <div class="fotoCategory">
                        <!-- en caso de que el producto no tenga imagen, hacemos un if para colocar una imagen por defecto, solo en ese caso -->
                        <?php if($pro->imagen) : ?>
                        <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="Camiseta">
                        <?php else: ?>
                            <img src="<?=base_url?>assets/img/default.png" alt="Camiseta">
                        <?php endif; ?>
                    </div>
                    

                    <div class="textoCategory">
                        
                        <p class="descripcionC"><?=$pro->descripcion?></p>
                        <p class="precioC">$<?=$pro->precio?> Dolares </p>
                        <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button"><i class="fas fa-shopping-cart"> </i>Comprar</a>
                        <!-- <a class="button" href="<?=base_url?>producto/ver&id=<?=$pro->id?>"><i class="fas fa-angle-double-right"></i>Ver Producto</a> -->
                    </div>
             </div>
            



<?php else: ?>

<h1 style="text-align: center; color: red;">*El producto no existe*</h1>

<?php endif; ?>

