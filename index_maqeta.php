<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de camisetas PHP</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="https://kit.fontawesome.com/4cb597c7f1.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- cabecera -->
    <header id="header">
            <div id="logo">
                <img src="./assets/img//camiseta.png" alt="Camiseta">
            </div>
            <div id="titulo">
            <a href="index.php"><h1>Tienda de camisetas</h1></a>
            </div>
    </header>

    <!-- menu -->
     <nav id="menu">
          <ul>
              <li><a href="#">Inicio</a></li>
              <li><a href="#">Categoria</a></li>
              <li><a href="#">Categoria</a></li>
              <li><a href="#">Categoria</a></li>
              <li><a href="#">Categoria</a></li>
              <li><a href="#">Categoria</a></li>
          </ul>
     </nav>

    <div id="content">

        <!-- barra lateral -->
        <aside id="lateral">
               <div id="login" class="block_aside">
                    <form action="#" method="POST">
                        <label for="email">Email</label> <br>
                        <input class="email" type="email" name="email"> <br>

                        <label  for="password">Contraseña</label> <br>
                        <input class="password" type="password" name="password"> <br>

                        <input class="enviar" type="submit" value="Enviar">
                    </form>
                     <div class="enlaces">
                         <div class="enlace1">
                         <a href="#"><i class="far fa-user"></i>Mis pedidos</a> <br>
                         </div>
                         <div class="enlace1">
                         <a href="#"><i class="fas fa-key"></i>Gestionar Pedidos</a> <br>
                         </div>
                         <div class="enlace1">
                         <a href="#"><i class="far fa-check-circle"></i>Gestionar Categorias</a> <br>
                         </div>
                   
                    
                     </div>
                     
               </div>

        </aside>
    
        <!-- contenido central -->
        <div id="central">
            <h1 class="destacado">Productos Destacados</h1>
             <div class="product">
                 <div class="foto">
                     <img src="./assets/img/camiseta.png" alt="Camiseta">

                 </div>
                 <div class="texto">
                     <h2>Camiseta Azul Manga Corta</h2>
                     <p>30 dolares</p>
                     <a href="#" class="button"><i class="fas fa-shopping-cart"> </i>Comprar</a>

                 </div>
             </div>
             
             <div class="product">
                 <div class="foto">
                     <img src="./assets/img/camiseta.png" alt="Camiseta">

                 </div>
                 <div class="texto">
                     <h2>Camiseta Azul Manga Corta</h2>
                     <p>30 dolares</p>
                     <a href="#" class="button"><i class="fas fa-shopping-cart"> </i>Comprar</a>

                 </div>
             </div>

             <div class="product">
                 <div class="foto">
                     <img src="./assets/img/camiseta.png" alt="Camiseta">

                 </div>
                 <div class="texto">
                     <h2>Camiseta Azul Manga Corta</h2>
                     <p>30 dolares</p>
                     <a href="#" class="button"><i class="fas fa-shopping-cart"> </i>Comprar</a>

                 </div>
             </div>

             <div class="product">
                 <div class="foto">
                     <img src="./assets/img/camiseta.png" alt="Camiseta">

                 </div>
                 <div class="texto">
                     <h2>Camiseta Azul Manga Corta</h2>
                     <p>30 dolares</p>
                     <a href="#" class="button"><i class="fas fa-shopping-cart"> </i>Comprar</a>

                 </div>
             </div>

             <div class="product">
                 <div class="foto">
                     <img src="./assets/img/camiseta.png" alt="Camiseta">

                 </div>
                 <div class="texto">
                     <h2>Camiseta Azul Manga Corta</h2>
                     <p>30 dolares</p>
                     <a href="#" class="button"><i class="fas fa-shopping-cart"> </i>Comprar</a>

                 </div>
             </div>
        </div>

    </div>
    
    <!-- footer -->
    <footer id="footer">
        <p>Desarrollado Por: Carlos David Barco Hurtado &copy;</p>
    </footer>


</body>
</html>