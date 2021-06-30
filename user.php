<?php


$mysqli = new mysqli('localhost', 'root', '', 'conf');

if(mysqli_connect_errno()){
    printf("Состыковочка с БД прошла усаешно", mysqli_connect_errno());
    exit();
}

$mysqli->set_charset('utf8');



//echo $name, $lastname, $login, $password;
$login = $_GET['login'];
$query_name =  $mysqli->query("SELECT name, lastname FROM USERS WHERE login LIKE '$login'");
$row_reg = mysqli_fetch_assoc($query_name);

$mysqli->close();

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

        <div v-model="login" id="name">
            <h2></h2>
        </div>
    </header>


    <main>
        <canvas hidden id='textCanvas'></canvas>
        <img v-bind:src="URL" alt="">
        <form method="post" id='forma'>
            <textarea v-model="form" wrap="hard" id = "text" required></textarea>
            <button id="cod" v-on:click="draw">{{encoding}}</button>
        </form>



        <div id="mod_menu">
            <form action="index.php" id="user">
                <button>{{exit}}</button>
            </form>
        </div>
    </main>


</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="static/script.js"></script>
<script>


    function getURLVarArr() {
        var data = [];
        var query = String(document.location.href).split('?');
        if (query[1]) {
            var part = query[1].split('&');
            for (i = 0; i < part.length; i++) {
                var dat = part[i].split('=');
                data[dat[0]] = dat[1];
            }
        }
        return data;
    }


    let data = [];
    data = getURLVarArr()
    app._data.login = data.login_log;
    app._data.password = data.password_log;
    console.log( app._data);



</script>
</body>

</html>
