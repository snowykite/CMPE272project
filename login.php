<?php
    // Start the session
    session_start();
    // Checks to see if the user is already logged in. If so, refirect to home page.
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
        header("Location: users.php");
    }
    // fake username and password
    $username = "admin";
    $password = "admin";
    // Checks to see if the username and password have been entered.
    // If so and are equal to the username and password defined above, log them in.
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($_POST['username'] == $username && $_POST['password'] == $password) {
            $_SESSION['loggedIn'] = true;
            header('Location: users.php');
        } else {
            $_SESSION['loggedIn'] = false;
            $error = "Invalid username and password!";
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
                echo "<a href=\"#\" class=\"navbar-brand\">Secure</a>";
            }
          ?>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
    
    <div class="container">

      <form class="form-signin" method="POST" action="login.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php
          echo '<pre>' . $error . '</pre>';
        ?>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>

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
