<?php 
    $mysqli = new mysqli("db", "user", "password", "appDB");
    $sql_check = "SELECT * FROM users WHERE grp='users'";
    $result_check = $mysqli->query($sql_check);
    foreach ($result_check as $row) {
        $name = $row['name']; 
        $pass = $row['pass'];
        if($_SERVER['PHP_AUTH_USER'] != $name and $_SERVER['PHP_AUTH_PW'] != $pass){
            echo '';
        } else {
            echo 'Доступ запрещен!';
            exit();
        }
    }
    
    
?>
<html lang="en">
	<head>
		<title>list products :)</title>
		<link rel="stylesheet" href="/protected/style.css" type="text/css"/>
	</head>
	<body>
		<div class="container"> 
		<h1>Список продуктов кофейни</h1>
		<table>
			<tr><th>Id</th><th>Продукт</th><th>Стоимость</th></tr>
			<?php

                #$mysqli = new mysqli("db", "user", "password", "appDB");

                $sql = 'SELECT * FROM products';

                $result = $mysqli->query($sql);
                
                foreach ($result as $row) {
                    echo "<tr><td>{$row['ID']}</td><td>{$row['product']}</td><td>{$row['price']}</td></tr>";
                }

                $user_name = $_SERVER['PHP_AUTH_USER'];
                $getc = $_GET['id'];
                $getproduct = $_GET['product'];
                $getprice = $_GET['price'];
                if($getc != ''){
                    $sql3 = "INSERT INTO orders(user, product, price) VALUES('$user_name', '$getproduct', '$getprice')";
                    $result3 = $mysqli->query($sql3);
                }
                echo "\nПараметр: " . $getc;
			?>
		</table>
        
		</div>
	</body>
</html>
