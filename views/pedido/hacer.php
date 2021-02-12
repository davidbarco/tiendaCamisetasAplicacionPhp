<?php if (isset($_SESSION["identity"])) : ?>
    <h1 style="text-align: center;">Hacer pedido</h1>
    <a href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>

    <!-- formulario de hacer pedido -->

    <!-- la action, apunta al metodo add, que se encuentra en pedido.php -->

    <h3>Direccion de envio</h3>



    <form class="form" action="<?=base_url?>pedido/add" method="POST">

        <label class="labelRegistro" for="provincia">Departamento</label> <br>
        <input class="inputRegistro" type="text" name="provincia" id="" required> <br>

        <label class="labelRegistro" for="Localidad">Ciudad</label> <br>
        <input class="inputRegistro" type="text" name="localidad" id="" required> <br>

        <label class="labelRegistro" for="direccion">Direccion</label> <br>
        <input class="inputRegistro" type="text" name="direccion" id="" required> <br>


        <input class="btnRegistro" type="submit" value="confirmar">
    </form>









<?php else : ?>

    <h1 style="text-align: center; margin-bottom: 30px;"><i class="fas fa-exclamation-triangle"></i>Necesitas estar identificado</h1>
    <p style="text-align: center;">Debes iniciar sesion para poder realizar tu pedido</p>

<?php endif; ?>