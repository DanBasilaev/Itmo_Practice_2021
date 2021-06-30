<?php

//echo "Login: $login_log <br> Password: $password_log";
$mysqli = new mysqli('localhost', 'root', '', 'conf');

if(mysqli_connect_errno()){
    printf("Состыковочка с БД прошла усаешно", mysqli_connect_errno());
    exit();
}

$mysqli->set_charset('utf8');
$name = "не определено";
$lastname = "не определен";
$login_log = "не определено";
$password_log = "не определен";

if(isset($_GET["login_log"])){

    $login_log = $_GET["login_log"];
}



if(isset($_GET["password_log"])){

    $password_log= $_GET["password_log"];
}

if (isset($_GET['login_log']) and isset($_GET['password_log'])){
    $query_login_check_log = $mysqli->query("SELECT * FROM USERS WHERE login LIKE'$login_log' AND password LIKE '$password_log'");
    $row_log = mysqli_fetch_assoc($query_login_check_log);
    if ($row_log['name'] === null){
        header('Location: http://conf.com/error.php');
        exit;
    }
    $name = $row_log['name'];
    $lastname = $row_log['lastname'];

}


$mysqli->close();
//echo $login_log, $password_log;


?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная</title>
    <link rel="shortcut icon" href="../static/unnamed.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../static/style.css">
</head>

<body>
<div id="app">

    <header  id="head">
        <h1>{{header}}</h1>

        <div id="name">
            <h2><?php echo $name?>  <?php echo $lastname?></h2>
        </div>
    </header>


    <main>
        <canvas hidden id='textCanvas'></canvas>
        <img v-bind:src="URL" alt="">
        <form method="post" action="../users/user.php" id='forma'>
            <textarea v-model="form" wrap="hard" id = "text" required></textarea>
            <button id="cod" v-on:click="draw">{{encoding}}</button>
        </form>



        <div id="mod_menu">
            <form action="../index.php" id="user">
                <button>{{exit}}</button>
            </form>
        </div>
    </main>


</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../static/script.js"></script>
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
        app._data.login = data.login_log;
        app._data.password = data.password_log;
        console.log(app._data);
        return data;
    }
    getURLVarArr()

</script>
</body>

</html>
