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

<?php
//------------------------Кодирование
$mysqli = new mysqli('localhost', 'root', '', 'conf');

if(mysqli_connect_errno()){
    printf("Состыковочка с БД прошла усаешно", mysqli_connect_errno());
    exit();
}

$mysqli->set_charset('utf8');

//print_r($URL = $_POST["URL"]);

if(isset($_POST["URL"])){
    $URL = $_POST["URL"];
    $query = "INSERT INTO images VALUES ('','$URL','$login_log')";
    $mysqli->query($query);
}


$query_history = $mysqli->query("SELECT * FROM images WHERE login LIKE'$login_log' ORDER BY ID DESC");





//------------------------Кодирование

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $name?>  <?php echo $lastname?></title>
    <link rel="shortcut icon" href="../static/unnamed.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../static/style.css"
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
        <form method="post" id='forma'>
            <input type="hidden" name="URL" value="" id="img_url">
            <textarea v-model="form" name="form" id = "text" required></textarea>
            <button id="cod" v-on:click="draw">{{encoding}}</button>
        </form>

        <img hidden id="img_show" src="">



        <div id="mod_menu">
            <?php

            $count = 0;
            while (($row = mysqli_fetch_assoc($query_history)) && $count < 5){
                $count += 1;
                //print_r($row['uri']);
                ?>
                <button class="history" onclick="show('<?php echo $row['uri'];?>')">Cсылка № <?php echo $count;?></button>

                <?php
            }
            $mysqli->close();
            ?>
            <button class="history" style="color: red;" onclick="back()">Назад к кодированию</button>
            <form action="../index.php" id="user">
                <button>{{exit}}</button>
            </form>
        </div>
    </main>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

<script src="../static/script.js"></script>
<script>

    document.cookie = "<?php echo $name ?>=<?php echo $login_log?>"

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
        //console.log(app._data);
        return data;
    }
    getURLVarArr()

    function show(uri) {
        document.getElementById('text').hidden = true;
        document.getElementById('cod').hidden = true;
        let img = document.getElementById('img_show');
        img.hidden = false;
        img.setAttribute('src', uri)

    }
    function back() {
        document.getElementById('text').hidden = false;
        document.getElementById('cod').hidden = false;
        let img = document.getElementById('img_show');
        img.hidden = true;
        img.setAttribute('src', '')
    }





</script>
</body>

</html>
