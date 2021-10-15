<?php 
    $mysqli = new mysqli("db", "user", "password", "appDB");
    $sql_check = "SELECT * FROM users WHERE grp='admins'";
    $result_check = $mysqli->query($sql_check);
    foreach ($result_check as $row) {
        $name = $row['name']; 
        $pass = $row['pass'];
        if($_SERVER['PHP_AUTH_USER'] != $name and $_SERVER['PHP_AUTH_PW'] != $pass){
            echo '';
        } else {
            echo 'Запрещено';
            exit();
        }
    }
    
    
?>
<html lang="en">
	<head>
		<title>Get Coffee :)</title>
		<link rel="stylesheet" href="/protected/style.css" type="text/css"/>
	</head>
	<body>
		<div class="container">
        <a href="/protected/getcoffee/myorders.php" class="btn btn-success">Мои заказы</a>
		<h1>Выберите продукт</h1>
		<table>
			<tr><th>Id</th><th>Продукт</th><th>Стоимость</th><th>Заказать</th></tr>
			<?php

                $sql = 'SELECT * FROM products';

                $result = $mysqli->query($sql);
                
                foreach ($result as $row) {
                    echo "<tr><td>{$row['ID']}</td><td>{$row['product']}</td><td>{$row['price']}</td><td><a href='http://localhost/protected/getcoffee/getcoffee.php?id={$row['ID']}&product={$row['product']}&price={$row['price']}'>Заказать</a></td></tr>";
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
