    <!-- barra lateral -->
    <aside id="lateral">

       
       <!-- si hay un usuario logueado se muestra, de lo contrario no mostrar-->
       <?php if (isset($_SESSION["identity"])) : ?>
       <div id="login" class="block_aside">
          <h3 class="carritoV">mi carrito</h3>
          <div class="enlaces">

             <div class="enlace1">
                 <?php $stats = Utils::statsCarrito(); ?>
                <a href="<?= base_url ?>carrito/index"><i class="fab fa-product-hunt"></i>Productos: (<?=$stats["count"]?>)</a> <br>
             </div>

             <div class="enlace1">
                <a href="<?= base_url ?>carrito/index"><i class="fas fa-hand-holding-usd"></i>Total: $<?=$stats["total"]?></a> <br>
             </div>

             <div class="enlace1">
                <a href="<?= base_url ?>carrito/index"><i class="fas fa-sign-out-alt"></i>Ver el carrito</a> <br>
             </div>

          </div>

       </div>
       <?php endif; ?>





       <div id="login" class="block_aside">

          <?php if (!isset($_SESSION["identity"])) : ?>

             <form action="<?= base_url ?>usuario/login" method="POST">
            
                <label for="email">Email</label> <br>
                <input class="email" type="email" name="email"> <br>

                <label for="password">Contraseña</label> <br>
                <input class="password" type="password" name="password"> <br>

                <input class="enviar" type="submit" value="Enviar">
             </form>

          <?php else : ?>

             <h3 class="carritoV"><?= $_SESSION["identity"]->nombre ?> <?= $_SESSION["identity"]->apellidos ?></h3>

          <?php endif; ?>



          <div class="enlaces">



             <!-- si el usuario es un administrador, le aparecen estos dos botones -->
             <?php if (isset($_SESSION["admin"])) : ?>

                <div class="enlace1">
                   <a href="<?= base_url ?>categoria/index"><i class="far fa-check-circle"></i>Gestionar Categorias</a> <br>
                </div>
                <div class="enlace1">
                   <a href="<?= base_url ?>producto/gestion"><i class="fas fa-key"></i>Gestionar Productos</a> <br>
                </div>

                <div class="enlace1">
                   <a href="<?= base_url ?>pedido/gestion"><i class="far fa-check-circle"></i>Gestionar pedidos</a> <br>
                </div>
             <?php endif; ?>

             <!-- si el usuario está logueado, le aparecen estos botones -->
             <?php if (isset($_SESSION["identity"])) : ?>

                <div class="enlace1">
                   <a href="<?= base_url ?>pedido/mis_pedidos"><i class="far fa-user"></i>Mis pedidos</a> <br>
                </div>

                <div class="enlace1">
                   <a href="<?= base_url ?>usuario/logout"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a> <br>
                </div>

             <?php else : ?>
                <!-- boton para que el usuario pueda registrarse -->
                <div class="enlace1 registro">
                   <a href="<?= base_url ?>usuario/registro"><i style="margin-right: 7px;" class="fas fa-sign-in-alt"></i>Registrate Aqui</a> <br>
                </div>

             <?php endif; ?>


          </div>

       </div>

    </aside>

    <div id="central">