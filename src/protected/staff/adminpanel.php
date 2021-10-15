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
		<title>Add products :)</title>
		<link rel="stylesheet" href="/protected/style.css" type="text/css"/>
	</head>
	<body>
		<div class="container">
        <a href="/protected/staff/listofproducts.php" class='btn'>Список продуктов</a>
        <h1>Добавить продукт</h1>
        <form method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1">Название продукта</label>
                <input type="text" name="product" id="exampleFormControlInput1" placeholder="Введите название продукта">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Стоимость продукта</label>
                <input type="text" name="price" id="exampleFormControlInput1" placeholder="Введите стоимость продукта">
            </div>
            <input type="submit" name="button" class="btn" value="OK">
        </form>
        <?php 
            $product = $_POST['product'];
            $price = $_POST['price'];
            if(isset($_POST['button'])){
                $sql_add = "INSERT INTO products(product, price) VALUES('$product', '$price')";
                $result = $mysqli->query($sql_add);
            }
        ?>
		</div>
	</body>
</html>
