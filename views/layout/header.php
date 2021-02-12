<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de camisetas PHP</title>
    <link rel="stylesheet" href="<?=base_url?>./assets/css/styles.css">
    <script src="https://kit.fontawesome.com/4cb597c7f1.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="<?=base_url?>./assets/img/camiseta.png" type="image/x-icon">
    
</head>
<body>
    <!-- cabecera -->
    <header id="header">
            <div id="logo">
                <img src="<?=base_url?>./assets/img//camiseta.png" alt="Camiseta">
            </div>
            <div id="titulo">
            <a href="<?=base_url?>"><h1 class="titulos">Camisetas Nike</h1></a>
            </div>
    </header>

    <!-- menu -->
     
    <!-- para listar todas mis categorias -->
    <?php $categorias = Utils::showCategorias(); ?>
     <nav id="menu">
          <ul>
              <li><a href="<?=base_url?>"><i class="fas fa-home"></i>Inicio</a></li>

            
              <?php while($cat = $categorias->fetch_object()) : ?>
                    
                <li>
                       <!-- en este enlace meto el id de cada categoria -->
                <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><i class="fas fa-tshirt"></i><?=$cat->nombre?></a>
                
                </li>

              <?php endwhile; ?>
             
              
          </ul>
     </nav>

    <div id="content">