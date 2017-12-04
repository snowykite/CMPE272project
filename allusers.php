<?php
    $dsn = 'mysql:host=localhost;dbname=mymilkte_products';
    $username = 'mymilkte_admin';
    $password = 'admin';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ); 
    $db = new PDO($dsn, $username, $password, $options);
    $query = "SELECT * FROM users";
    $stmt = $db->query($query);
    if ($stmt) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    foreach ($result as $row) {
        echo  " First Name: " . $row["first_name"] .
	    " Last Name: " . $row["last_name"].
	    " Email: " . $row["email"].
	    " Address : " . $row["address"].
	    " Home Phone: " . $row["home_phone"].
	    " Cell Phone: " . $row["cell_phone"].
	    "<br>";
    }
?>