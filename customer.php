<?php
    $dsn = 'mysql:host=localhost;dbname=mymilkte_products';
    $username = 'mymilkte_admin';
    $password = 'admin';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ); 
    $db = new PDO($dsn, $username, $password, $options);
    $BASE_QUERY = "SELECT * FROM users WHERE 1"; // base query
    $query = $BASE_QUERY;
    
    if (!empty($_POST['fname'])) {
        $query = $query . " AND first_name = '{$_POST['fname']}'";
    }
    
    if (!empty($_POST['lname'])) {
        $query = $query . " AND last_name = '{$_POST['lname']}'";
    }
    
    if (!empty($_POST['email'])) {
        $query = $query . " AND email = '{$_POST['email']}'";
    }
    
    if (!empty($_POST['phone'])) {
        $query = $query . " AND (home_phone = '{$_POST['phone']}' OR cell_phone = '{$_POST['phone']}')";
    }
    
    if ($query !== $BASE_QUERY) { // search if form is submit
        $stmt = $db->query($query);
        if ($stmt) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                  <li><a class="navbar-brand" href="#">Search Users</a></li>
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

        <form class="form-signin" method="POST" action="customer.php">
            <h2 class="form-signin-heading">Search User:</h2>
          <label for="inputFirstName" class="sr-only">First Name</label>
          <input type="text" id="inputFirstName" name="fname" class="form-control" placeholder="First Name" autofocus>
          <label for="inputLastName" class="sr-only">Last Name</label>
          <input type="text" id="inputLastName" name="lname" class="form-control" placeholder="Last Name">
          <label for="inputEmail" class="sr-only">Email</label>
          <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email Address">
          <label for="inputPhone" class="sr-only">Phone #</label>
          <input type="text" id="inputPhone" name="phone" class="form-control" placeholder="Phone # (123-456-7890)">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Search!</button>
        </form>
        
      </div>
      <div class="container search-result">
        <ul class="list-unstyled">
          <?php
            foreach ($result as $line) {
                echo "<li>Name: {$line['first_name']} {$line['last_name']}<ol><li>Email: {$line['email']}</li><li>Address: {$line['address']}</li><li>Cell #: {$line['cell_phone']}</li></ol></li>";
            }
          ?>
        </ul>
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
