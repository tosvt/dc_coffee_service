<?php 
// die(var_dump($_POST));
header('Content-type: json/application');

$connect = new mysqli("db", "user", "password", "appDB");

$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
echo "Тип: ".$q;
$param = explode('/', $q);
$type = $param[0];
$id = $param[1];

if($method === 'GET'){
    if($type === 'users'){
        if(isset($id)){
            $user = mysqli_query($connect, "SELECT * FROM users WHERE id = '$id'");
            if(mysqli_num_rows($user) === 0){
                http_response_code(404);
                $res = ["status" => false, "message" => "User not found"];
                echo json_encode($res);
            } else {
                $user = mysqli_fetch_assoc($user);
                echo json_encode($user);
            }
        } else {
            $users = mysqli_query($connect, "SELECT * FROM users");
            $userList = [];
            while($user = mysqli_fetch_assoc($users)){
                $userList[] = $user;
            }
            echo json_encode($userList);
        }
    } elseif ($type === 'getcoffee'){
        if(isset($id)){
            $user = mysqli_query($connect, "SELECT * FROM products WHERE id = '$id'");
            if(mysqli_num_rows($user) === 0){
                http_response_code(404);
                $res = ["status" => false, "message" => "User not found"];
                echo json_encode($res);
            } else {
                $user = mysqli_fetch_assoc($user);
                echo json_encode($user);
            }
        } else {
            $users = mysqli_query($connect, "SELECT * FROM products");
            $userList = [];
            while($user = mysqli_fetch_assoc($users)){
                $userList[] = $user;
            }
            echo json_encode($userList);
        }
    }  elseif ($type === 'myorders'){
        if(isset($id)){
            $user = mysqli_query($connect, "SELECT * FROM orders WHERE id = '$id'");
            if(mysqli_num_rows($user) === 0){
                http_response_code(404);
                $res = ["status" => false, "message" => "Order not found"];
                echo json_encode($res);
            } else {
                $user = mysqli_fetch_assoc($user);
                echo json_encode($user);
            }
        } else {
            $users = mysqli_query($connect, "SELECT * FROM orders");
            $userList = [];
            while($user = mysqli_fetch_assoc($users)){
                $userList[] = $user;
            }
            echo json_encode($userList);
        }
    }
} elseif ($method === 'POST'){
    if($type === 'users'){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $pass = $_POST['pass'];
        $grp = $_POST['grp'];
        echo $title . " " . $body . " " . $pass . " ". $grp . " Переменная: " . $_POST['title'] . "<br><hr><br>" . $_POST['body'];
        $pass = 'pass';
        $v = 'чтото';
        mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `surname`, `pass`, `grp`) VALUES (NULL, '$name', '$surname', '$pass', '$grp');");
        http_response_code(201);
        $res = ["status" => true, "user_id" => mysqli_insert_id($connect)];
        echo json_encode($res);
        
    } elseif($type === 'adminadd'){
        $product = $_POST['product'];
        $price = $_POST['price'];
        mysqli_query($connect, "INSERT INTO `products` (`id`, `product`, `price`) VALUES (NULL, '$product', '$price');");
        http_response_code(201);
        $res = ["status" => true, "user_id" => mysqli_insert_id($connect)];
        echo json_encode($res);
        
    }
} elseif($method === 'PATCH'){
    if($type === 'users'){
        if(isset($id)){
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            $name = $data['name'];
            $surname = $data['surname'];
            $pass = $data['pass'];
            $grp = $data['grp'];
            mysqli_query($connect, "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `pass` = '$pass', `grp` = '$grp' WHERE `users`.`id` = '$id';");

            http_response_code(200);
            $res = ["status" => true, "message" => "User is updated"];
            echo json_encode($res);
        }
    }
} elseif($method === 'DELETE'){
    if($type === 'users'){
        if(isset($id)){
            
            mysqli_query($connect, "DELETE FROM `users` WHERE `users`.`id` = '$id'");

            http_response_code(200);
            $res = ["status" => true, "message" => "User is Deleted"];
            echo json_encode($res);
        }
    }
}
