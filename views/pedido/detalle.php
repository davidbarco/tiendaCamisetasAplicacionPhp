<h1 style="color: white; text-align:center;">Detalle Del Pedido</h1>



 <!-- los datos del pedido solo se van a mostrar si existe pedido -->
 <?php if (isset($pedido)) : ?>


         <!-- boton para poder cambiar el estado del pedido -->
         <?php if(isset($_SESSION["admin"])) : ?>
        <h3 style="text-align: center;">Cambiar estado del pedido</h3>
        <form action="<?=base_url?>pedido/estado" method="POST">
        
        <input type="hidden" name="pedido_id" value="<?=$pedido->id?>">
        <select name="estado" id="">

        <option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '';?>>Pendiente</option> <br>
        <option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>>En preparacion</option> <br>
        <option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '';?>>listo para envio</option> <br>
        <option value="sended" <?=$pedido->estado == "sended" ? 'selected' : '';?>>Enviado</option> <br>
        
        </select> <br>

        <input class="button" type="submit" value="Cambiar estado">
        
        
        </form>

        <?php endif; ?>

        <h3>Direccion de envio</h3>
        <li>Deparamento: <?= $pedido->provincia?></li>
            <li>Ciudad: <?= $pedido->localidad?></li>
            <li>Direccion: <?= $pedido->direccion?></li>

        <h3>Datos del pedido:</h3>

            <li>Estado de pedido: <?=Utils::showStatus($pedido->estado)?></li>
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