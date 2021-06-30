<?php

//------------------Регистрация--------------------
$mysqli = new mysqli('localhost', 'root', '', 'conf');

if(mysqli_connect_errno()){
    printf("Состыковочка с БД прошла усаешно", mysqli_connect_errno());
    exit();
}

$mysqli->set_charset('utf8');


if (isset($_POST['name'])){
    $name = $_POST['name'];
}
if (isset($_POST['lastname'])){
    $lastname = $_POST['lastname'];
}
if (isset($_POST['login'])){
    $login = $_POST['login'];
}
if (isset($_POST['password'])){
    $password = $_POST['password'];
}

//echo $name, $lastname, $login, $password;

if (isset($_POST['login'])){
$query_login_check_reg =  $mysqli->query("SELECT login FROM USERS WHERE login LIKE '$login'");
$row_reg = mysqli_fetch_assoc($query_login_check_reg);


}
if (isset($_POST['name']) AND isset($_POST['lastname']) AND isset($_POST['login']) AND isset($_POST['password'])) {
    $query_reg = "INSERT INTO users VALUES ('$name' , '$lastname', '$login', '$password')";
    $mysqli->query($query_reg);
}


$mysqli->close();




//------------------Вход--------------------
$mysqli = new mysqli('localhost', 'root', '', 'conf');

if(mysqli_connect_errno()){
    printf("Состыковочка с БД прошла усаешно", mysqli_connect_errno());
    exit();
}

$mysqli->set_charset('utf8');

if (isset($_GET['login_log'])){
    $login_log = $_GET['login_log'];
}
if (isset($_GET['password_log'])){
    $password_log = $_GET['password_log'];
}
if (isset($_GET['login_log']) and isset($_GET['password_log'])){
    $query_login_check_log = $mysqli->query("SELECT * FROM USERS WHERE login LIKE'$login_log' AND password LIKE '$password_log'");
    $row_log = mysqli_fetch_assoc($query_login_check_log);
    print_r($row_log);
}


//echo $login_log, $password_log;


//------------------ Конец Входа --------------------

?>



<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная</title>
    <link rel="shortcut icon" href="static/unnamed.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="static/style.css">
</head>

<body>
<div id="app">

    <header  id="head">
        <h1>{{header}}</h1>
        <div id="sign-log">
            <button v-on:click="logBtn">{{log_in}}</button>
            <button v-on:click="regBtn">{{sign_up}}</button>
        </div>

    </header>


    <main>
        <canvas hidden id='textCanvas'></canvas>
        <img v-bind:src="URL" alt="">
        <form method="post" action="" id='forma'>
            <textarea v-model="form" wrap="hard" id = "text" required></textarea>
            <button id="cod" v-on:click="">{{encoding}}</button>
        </form>



        <div id="mod_menu">
            <div hidden id="user">
                <button v-on:click="">{{exit}}</button>
            </div>


            <form method="post" hidden class="menu" id="reg" action="">
                <input v-model="name" type="text" name="name" required placeholder="Введите Имя">
                <input v-model="lastname" type="text" name="lastname" required placeholder="Введите Фамилию">
                <input v-model="login" type="text" name="login" required placeholder="Введите логин">
                <input v-model="password" type="password" name="password" required placeholder="Введите пароль">
                <button  v-on:click="regBtn_menu">{{registration}}</button>
                <?php
                if (isset($row_reg)){
                    if ($row_reg != null){ ?>
                    <script>alert('Такой пользователь уже есть в системе')</script><?php
                    }
                }
                ?>

            </form>

            <form method="get" hidden action="users/user.php" class="menu" id="log">
                <input v-model="login" type="text" name="login_log" required placeholder="Введите логин">
                <input v-model="password" type="password" name="password_log" required placeholder="Введите пароль">
                <button  v-on:click="logBtn_menu">{{log}}</button>
            </form>

        </div>
    </main>


</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="static/script.js"></script>
</body>

</html>
