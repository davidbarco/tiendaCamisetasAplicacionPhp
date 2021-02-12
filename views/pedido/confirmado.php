<!-- esto se mostrará cuando el pedido haya sido confirmado correctamente  -->
<?php if (isset($_SESSION["pedido"]) && $_SESSION["pedido"] == "complete") : ?>
    <h1 style="text-align: center; margin-bottom: 20px;">Tu pedido se ha confirmado</h1>

    <p style=" margin-bottom: 20px;"><i style="color: blue;" class="far fa-check-circle"></i>Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria a la cuenta 345433838383ADUE2 con el coste del pedido, será procesado y enviado</p>



    <!-- los datos del pedido solo se van a mostrar si existe pedido -->
    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido:</h3>

        
            <li>Numero de pedido: <?= $pedido->id ?></li>
            <li>Total a pagar: <?= $pedido->coste ?></li>
            <li>Productos: </li>

             <table class="tableConfirmacion"> 
             <tr>
        <th>IMAGEN</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>UNIDADES</th>


     </tr>

            <?php while ($producto = $productos->fetch_object()) :  ?>

                <tr class="datosPedido">

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
                    <td> <?= $producto->unidades?></td>

                </tr>


            <?php endwhile; ?>
            </table>


       

    <?php endif; ?>




<?php elseif (isset($_SESSION["pedido"]) && $_SESSION["pedido"] != "complete") : ?>

    <h1>Tu pedido no ha podido ser confirmado</h1>



<?php endif; ?>