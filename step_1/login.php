<!doctype html>

<html lang="en">

<?php require_once 'step_1.php'; ?>

  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/inscription.css" rel="stylesheet">
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
          <span class="sr-only">(current)</span>
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
    <!-- Links -->
    <form class="form-inline">
      <div class="md-form my-0">
        <input id="search" class="form-control mr-sm-5" type="text" placeholder="Search">
      </div>
    </form>
    <button type="button" class="btn btn-default btn-lg">
      <span class="icon icon-shopping-cart"></span> Add to cart
    </button>

  </div>
  <!-- Collapsible content -->
</nav>
<!--/.Navbar-->
</div>

  

    <div class="container">
        <form method="post" action="" class="border border-blue p-5">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remember_me">
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
        <a href="inscription.php" class="btn btn-primary">Or go here to register</a>
        <br>
        <?php login(); ?>
        </form>

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