<?php if (isset($gestion)) : ?>

    <h1 style="text-align: center;">Gestionar pedidos</h1>
<?php else : ?>
    <h1 style="text-align: center;">Mis pedidos</h1>

<?php endif; ?>





<table class="table">

    <tr>
        <th>N° PEDIDO</th>
        <th>COSTE</th>
        <th>FECHA</th>
        <th>HORA</th>
        <th>ESTADO</th>



    </tr>

    <!-- que me cree una variable llamada $ped  -->
    <?php while ($ped = $pedidos->fetch_object()) : ?>


        <tr>

            <td><a style="color: white;" href="<?= base_url ?>pedido/detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a></td>
            <td>$<?= $ped->coste ?></td>
            <td><?= $ped->fecha ?></td>
            <td><?= $ped->hora ?></td>
            <td> <?=Utils::showStatus($ped->estado)?></td>



        </tr>



    <?php endwhile; ?>
</table>