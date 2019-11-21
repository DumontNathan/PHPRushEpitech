<!doctype html>


<html lang="en">

<?php require_once 'step_1.php';
      require_once 'adminProduct.php'; ?>

  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../css/inscription.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Le groupe de merde</title>
  </head>

  <body>

  <div navbar>
  <!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
  <!-- Navbar brand -->
  <a class="navbar-brand" href="../index.php"><img class="img" src="../img/Good-Morning-Paris.png"></a>
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
        <a class="nav-link" href="../index.php">Home
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

    <div class="big-container">
      <div class="w3-sidebar w3-bar-block" id="sidenav">
            <a href="../admin.php"><h3 class="w3-bar-item">Admin</h3>
            <a href="create_user.php" class="w3-bar-item w3-button">Create user</a>
            <a href="edit_user.php" class="w3-bar-item w3-button">Edit user</a>
            <a href="display_user.php" class="w3-bar-item w3-button">Display user</a>
            <a href="delete_user.php" class="w3-bar-item w3-button">Delete user</a>
            <a href="add_product.php" class="w3-bar-item w3-button">Add product</a>
            <a href="edit_product.php" class="w3-bar-item w3-button">Edit product</a>
            <a href="delete_product.php" class="w3-bar-item w3-button">Delete product</a>
        </div>

      <div class="container">
          <form method="post" action="" class="border border-blue p-5">
          <div class="form-group">
              <h3>Choose the product to delete</h3>
              <br>
              <label for="product_id">Choose by ID</label>
              <input type="number" class="form-control" name="product_id" required>
              <small class="form-text text-muted">Display products to know the ID</small>
          </div>
          <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="Delete">
                    <label class="form-check-label" for="Delete">I confirm that i want to DELETE this product</label>
          </div>
          <?php deleteProduct($_POST["product_id"]); ?>
          <br>
          <button type="submit" class="btn btn-primary">Delete</button>

          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Display products
          </button>
      
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <?php 
                      
                $model = new Model();
                $array = $model->getAllProducts();

                echo '<table class="table table-striped">';
                echo '<tr><th>ID</th><th>Product name</th><th>Price (€)</th><th>Category ID</th></tr>';
                foreach( $array as $item )
                {
                    echo '<tr>';
                    foreach( $item as $key )
                    {
                        echo '<td>'.$key.'</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
                            
              ?>
            </div>
          </div>

          </form>
        </div>
      </div>          
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

</html>