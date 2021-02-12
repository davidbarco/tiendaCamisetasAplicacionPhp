<h1 style="text-align: center;">Carrito de la compra</h1>



<!-- esta tabla solo se muestra si hay productos en el carrito -->
<?php if(isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) >= 1) : ?>

<table class="table">

    <tr>
        <th>IMAGEN</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>UNIDADES</th>
        <th>ELIMINAR</th>

    </tr>


    <?php foreach ($carrito as $indice => $elemento) :
        $producto = $elemento["producto"];

    ?>


        <tr>

            <td>
                <!-- en caso de que el producto no tenga imagen, hacemos un if para colocar una imagen por defecto, solo en ese caso -->
                <?php if ($producto->imagen) : ?>
                    <img class="img_carrito" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="Camiseta">
                <?php else : ?>
                    <img class="img_carrito" src="<?= base_url ?>assets/img/default.png" alt="Camiseta">
                <?php endif; ?>

            </td>

            <td><a style="color: white;" href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre; ?></a></td>
            <td> <?= $producto->precio; ?></td>

           

            <td> 
            <a class="buttonMas" href="<?=base_url?>carrito/up&index=<?=$indice?>">+</a>
            <?= $elemento["unidades"] ?>
            <a class="buttonMas" href="<?=base_url?>carrito/down&index=<?=$indice?>">-</a>
            </td>

            

            <td><a href="<?=base_url?>carrito/remove&index=<?=$indice?>" class="hacer">Quitar</a></td>

        </tr>



    <?php endforeach; ?>
</table>

<table class="table">
    <tr>
        <th>Resumen de tu compra</th>
    </tr>
    <tr>
        <!-- precio total de los productos -->
        <?php $stats = Utils::statsCarrito(); ?>
        <td>Precio total: $<?= $stats["total"] ?> </td>

    </tr>
    <tr>
        
        <td><a href="<?=base_url?>pedido/hacer" class="hacer">Hacer Pedido</a></td>

        

    </tr>

    <td><a href="<?=base_url?>carrito/delete_all" class="hacer red">Vaciar carrito</a></td>

</table>

<?php else: ?>

<h3 style="text-align: center;">Tu carrito está vacio, añade algun producto</h3>

<?php endif; ?>