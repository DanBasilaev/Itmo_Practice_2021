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
$count_reg = mysqli_fetch_array($query_login_check_reg);
}

if ( $count_reg == 0) {
    $query_reg = "INSERT INTO users VALUES ('$name' , '$lastname', '$login', '$password', '')";
    $mysqli->query($query_reg);
}
$mysqli->close();

//------------------ Конец Регистрации --------------------



//------------------Вход--------------------
$mysqli = new mysqli('localhost', 'root', '', 'conf');

if(mysqli_connect_errno()){
    printf("Состыковочка с БД прошла усаешно", mysqli_connect_errno());
    exit();
}

$mysqli->set_charset('utf8');

if (isset($_GET['login'])){
    $login_log = $_GET['login'];
}
if (isset($_GET['password'])){
    $password_log = $_GET['password'];
}
//echo $login_log, $password_log;

if (isset($_GET['login']) and isset($_GET['password'])){
    $query_login_check_log =  $mysqli->query("SELECT login FROM USERS WHERE login LIKE '$login_log' and password LIKE '$password_log'");
    $count_log = mysqli_fetch_array($query_login_check_log);
}

$mysqli->close();
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



        <div hidden id="name">
         <?php
         if ($count_log != 0){
         ?>
            <h2>{{name}} {{lastname}}</h2> <?php
         }

         else{
            ?>
            <script>alert("Логин или пароль введены неверно")</script><?php
         }?>

        </div>
    </header>


    <main>
        <canvas hidden id='textCanvas'></canvas>
        <img v-bind:src="URL" alt="">
        <form method="post" action="" id='forma'>
            <textarea v-model="form" wrap="hard" id = "text" required></textarea>
            <button id="cod" v-on:click="draw">{{encoding}}</button>
        </form>



        <div id="mod_menu">
            <div hidden id="user">
                <button v-on:click="exitBtn">{{exit}}</button>
            </div>



            <form method="post" hidden action="/" class="menu"  id="reg">
                <input v-model="name" type="text" name="name" required placeholder="Введите Имя">
                <input v-model="lastname" type="text" name="lastname" required placeholder="Введите Фамилию">
                <input v-model="login" type="text" name="login" required placeholder="Введите логин">
                <input v-model="password" type="password" name="password" required placeholder="Введите пароль">
                <button v-on:click="regBtn_menu">{{registration}}</button>
                <?php if ($count_reg != 0){
                    ?>
                    <script>alert("такой логин уже занят")</script>
                    <?php
                } ?>
            </form>





            <form method="get" hidden action="/" class="menu" id="log">
                <input v-model="login" type="text" name="login" required placeholder="Введите логин">
                <input v-model="password" type="password" name="password" required placeholder="Введите пароль">
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
