<!doctype html>

<html lang="en">
<?php require_once 'step_1.php'; 
      require_once 'adminUser.php';?>

  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/inscription.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Le groupe de merde</title>
  </head>

  <body>

  <div class="w3-sidebar w3-blue w3-bar-block" id="sidenav">
        <h3 class="w3-bar-item">Menu</h3>
        <a href="create_user.php" class="w3-bar-item w3-button">Create user</a>
        <a href="edit_user.php" class="w3-bar-item w3-button">Edit user</a>
        <a href="display_user.php" class="w3-bar-item w3-button">Display user</a>
        <a href="delete_user.php" class="w3-bar-item w3-button">Delete user</a>
        <a href="#" class="w3-bar-item w3-button">Add product</a>
        <a href="#" class="w3-bar-item w3-button">Edit product</a>
        <a href="#" class="w3-bar-item w3-button">Display product</a>
        <a href="#" class="w3-bar-item w3-button">Delete product</a>
    </div>


 <div class="container">
      <form method="post" action="" class="border border-blue p-5">
      <div class="form-group">
        <p>Choose the user</p>
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Enter username" required>
        <br>
        <button type="submit" class="btn btn-primary">Display</button>
        <br><br>
            <?php $array = display_user();
                    if($array)
                    {
                        ?>
                        <p>Name : <?= $array["username"]?><br>
                        <p>Email : <?= $array["email"]?><br>
                        <p>Hash password : <?= $array["password"]?><br>
                        <p>Admin (1=is admin or 0=not admin) : <?= $array["admin"]?><br></p>
            <?php
                    } 
            ?>
    </form>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

</html>