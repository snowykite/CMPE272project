<?php
    // Start the session
    session_start();
    $dsn = 'mysql:host=localhost;dbname=mymilkte_products';
    $username = 'mymilkte_admin';
    $password = 'admin';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ); 
    $db = new PDO($dsn, $username, $password, $options);
    $query = "SELECT * FROM products WHERE id = {$_GET['id']}";
    $stmt = $db->query($query);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $line = $result[0];
    $newCount = $line['view_count'] + 1;
    $query = "UPDATE products SET view_count = {$newCount} WHERE id = {$_GET['id']}";
    $stmt = $db->query($query);
    
    $lastViewedIds = $_COOKIE['lastViewedIds'];
    $ids = explode(",", $lastViewedIds);
    $uids = [];
    foreach ($ids as $id) {
        if (count($uids) >= 5) break;
        if (!in_array($id, $uids)) {
            array_push($uids, $id);
        }
    }
    $uid_str = implode(",", $uids);
    setcookie('lastViewedIds', $uid_str ? "{$_GET['id']}," . $uid_str : "{$_GET['id']}");
    $query = "SELECT * FROM products WHERE id IN ({$uid_str}) ORDER BY FIELD (id, {$uid_str})";
    $stmt = $db->query($query);
    $lastViewed = [];
    if ($stmt) {
        $lastViewed = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="main.css" rel="stylesheet">
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
          <?php
            // Checks to see if the user is already logged in. If so, refirect to correct page.
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                echo "<a href=\"users.php\" class=\"navbar-brand\">Users</a>";
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

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading"><?php echo $line['title'] ?></h1>
          <img src=<?php echo "'" . $line['imageUrl'] . "'"?> style="max-height:500px;">
          <p class="lead text-muted"><?php echo $line['description']?></p>
        </div>
      </section>

      <div class="album text-muted">
        <div class="container">
          <h2 class="jumbotron-heading">Recently Viewed:</h2>
          <div class="row">
            <?php
                foreach ($lastViewed as $line) {
                    echo "<div class=\"card card-mid\"><a href=\"product.php?id={$line['id']}\"><img src=\"{$line['imageUrl']}\" alt=\"Card image cap\"></a><p class=\"card-text\">{$line['title']}</p></div>";
                }
            ?>
          </div>
        </div>
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
