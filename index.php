<?php
session_start();
require_once("statistics.php"); ?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" href = "assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Browser statistics</title>
</head>
<body>
<section>
<div class="container">
    <div class="title">Browser statistics</div>
    <div class="button-wrapper">
        <form action="" method="post">
            <input class="button" type="submit" name="show" value="Show statistics">
        </form>
    </div>
    <?php
        updateBrowserTable();
        outputBrowserTable();
    ?>
</div>
</section>
</body>
</html>