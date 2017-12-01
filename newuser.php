<?php
    $dsn = 'mysql:host=localhost;dbname=mymilkte_products';
    $username = 'mymilkte_admin';
    $password = 'admin';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ); 
    $db = new PDO($dsn, $username, $password, $options);
    $query = "INSERT INTO users (first_name, last_name, email, address, home_phone, cell_phone) VALUES "; // base query
    $address = empty($_POST['address']) ? null : $_POST['address'];
    $home_phone = empty($_POST['home_phone']) ? null : $_POST['home_phone'];
    $cell_phone = empty($_POST['cell_phone']) ? null : $_POST['cell_phone'];
    $vals = "('{$_POST['fname']}','{$_POST['lname']}','{$_POST['email']}','{$address}','{$home_phone}','{$cell_phone}')";
    $query = $query . $vals;
    if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email'])) { // required
        $stmt = $db->query($query);
        if ($stmt) {
            $msg = "User Created!";
        } else {
            $msg = "Fail to create user!";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>My Milk Tea Online</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="shared.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">
                  My Milk Tea Online is a dedicated platform to share information of milk tea drinks.
              </p>
            </div>
            <div class="col-sm-4 py-4">
              <h4 class="text-white">Contact</h4>
              <ul class="list-unstyled">
                <?php
                $contact = fopen("contact.txt", "r");
                while(!feof($contact)) {
                    echo "<li class=\"text-white\">" . fgets($contact) . "</li>";
                }
                fclose($contact);
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark">
        <div class="container d-flex justify-content-between">
          <a href="index.php" class="navbar-brand">Home</a>
          <a href="news.php" class="navbar-brand">News</a>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
              <ul class="dropdown-menu bg-dark">
                  <li><a class="navbar-brand" href="customer.php">Search Users</a></li>
                  <li><a class="navbar-brand" href="newuser.php">Create User</a></li>
              </ul>
          </li>
          <?php
            // Checks to see if the user is already logged in. If so, refirect to correct page.
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                echo "<a href=\"users.php\" class=\"navbar-brand\">Secure</a>";
            } else {
                echo "<a href=\"login.php\" class=\"navbar-brand\">Secure</a>";
            }
          ?>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">
      <div class="container">
        <?php
          if (!empty($msg)) {
            echo '<pre>' . $msg . '</pre>';
          }
        ?>
        <form class="form-signin" method="POST" action="newuser.php">
          <h2 class="form-signin-heading">Create User:</h2>
          <label for="inputFirstName" class="sr-only">First Name</label>
          <input type="text" id="inputFirstName" name="fname" class="form-control" placeholder="First Name" required autofocus>
          <label for="inputLastName" class="sr-only">Last Name</label>
          <input type="text" id="inputLastName" name="lname" class="form-control" placeholder="Last Name" required>
          <label for="inputEmail" class="sr-only">Email</label>
          <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email Address" required>
          <label for="inputEmail" class="sr-only">Home Address</label>
          <input type="text" id="inputEmail" name="address" class="form-control" placeholder="Home Address">
          <label for="inputEmail" class="sr-only">Home Phone</label>
          <input type="text" id="inputEmail" name="home_phone" class="form-control" placeholder="Home Phone # (123-456-7890)">
          <label for="inputPhone" class="sr-only">Cell Phone #</label>
          <input type="text" id="inputPhone" name="cell_phone" class="form-control" placeholder="Cell Phone # (123-456-7890)">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        </form>
        
      </div>
    </main>

    <footer class="text-muted">
      <div class="container">
        <p>2017 Ruifeng Sheng</p>
        <p>SJSU CMPE 272</p>
        <p>v1.0</p>
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
      </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>
