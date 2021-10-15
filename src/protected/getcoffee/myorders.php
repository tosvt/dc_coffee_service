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
		<title>My orders</title>
		<link rel="stylesheet" href="/protected/style.css" type="text/css"/>
	</head>
	<body>
		
		<div class="container">
		<h1>Мои заказы</h1>
		<table>
			<tr><th>Id</th><th>Продукт</th><th>Стоимость</th></tr>
			<?php
                $user = $_SERVER['PHP_AUTH_USER'];
              
                $sql = "SELECT * FROM orders WHERE user = '$user'";

                $result = $mysqli->query($sql);
                
                foreach ($result as $row) {
                    echo "<tr><td>{$row['ID']}</td><td>{$row['product']}</td><td>{$row['price']}</td></tr>";
                }
			?>
		</table>
		</div>
	</body>
</html>
