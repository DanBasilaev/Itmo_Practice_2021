<?php

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная</title>
    <link rel="shortcut icon" href="static/unnamed.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../static/style.css">
</head>

<body>
<div id="app">

    <header  id="head">
        <h1>{{header}}</h1>

        <div id="name">
            <h2>{{name}} {{lastname}}</h2>
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
</body>

</html>
