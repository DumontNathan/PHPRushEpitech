<!doctype html>

<html lang="en">

<?php require_once 'step_1.php';
      require_once 'Admin/adminProduct.php' ?>

  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/inscription.css" rel="stylesheet">
    <link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <title>Le groupe de merde</title>
  </head>

  <body>

  <div navbar>
  <!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
  <!-- Navbar brand -->
  <a class="navbar-brand" href="index.php"><img class="img" src="img/Good-Morning-Paris.png"></a>
  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- Collapsible content -->
  <div class="collapse navbar-collapse">
    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home
        </a>
      </li>
      <!-- Dropdown -->
      <li class="nav-item dropdown multi-level-dropdown">
        <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle">Products</a>
        <ul class="dropdown-menu">
          <li class="dropdown-item p-1">
            <a href="#" class="dropdown">Product 1</a>
          </li>
          <li class="dropdown-item p-1">
            <a href="#" class="dropdown">Product 2</a>
          </li>
          <li class="dropdown-item p-1">
            <a href="#" class="dropdown">Product 3</a>
          </li>
          <li class="dropdown-item p-1">
            <a href="#" class="dropdown">Product 4</a>
          </li>
        </ul>
      </li>
    </ul>

    <p class="hello"><?php sayHello(); echo " !";?></p>
    <!-- Links -->
    <form class="form-inline">   
      <div class="md-form my-0">
        <input id="search" class="form-control mr-sm-5" type="text" placeholder="Search">
      </div>
    </form>
    <a class="btn btn-danger" href="">
    CART
    </a>
    <a class="btn btn-secondary" href="logout.php">Logout</a>
    <?php if(isAdmin())
        {
        ?> 
        <a class="btn btn-secondary" href="admin.php">Admin</a>
      
        <?php 
        } 
          ?>

  </div>
  <!-- Collapsible content -->
</nav>
<!--/.Navbar-->
</div>
<?php
$model = new Model();
$productArray1 = $model->getProduct(20);
$productArray2 = $model->getProduct(22);
$productArray3 = $model->getProduct(23);
$mieDePain = new Product($productArray1);
$poney = new Product($productArray2);
$ceBeauSite = new Product($productArray3);
?>


<!-- card -->
<div class="card-deck">
  <div class="card">
    <img src="img/miedepain.jpg" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title"><?= $mieDePain->getName();?></h5>
      <p class="card-text">Cette mie de pain a été réalisée avec le soutien de l'Atelier National de Boulangerie Française.</p>
      <p class="price">Price : <?= $mieDePain->getPrice();?> €</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img src="img/leponey.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?= $poney->getName();?></h5>
      <p class="card-text">Cet étonnant et révolutionnaire poney a été étalonné par la courbe d'étalonnage des étalons.</p>
      <p class="price">Price : <?= $poney->getPrice();?> €</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img src="img/Good-Morning-Paris.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?= $ceBeauSite->getName();?></h5>
      <p class="card-text">Nous avons la joie et la fierté de vous proposer notre tout nouveau site 
        (celui que vous visitez actuellement) à un prix défiant toute concurrence.</p>
      <p class="price">Price : <?= $ceBeauSite->getPrice();?> €</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</div>

   
    <!-- Footer -->
    <footer class="page-footer font-small">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright: Le groupe.</div>
    <!-- Copyright -->

    </footer>
    <!-- Footer --> 


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

</html>