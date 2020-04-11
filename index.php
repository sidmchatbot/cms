<?php
    $_ENV["GOOGLE_APPLICATION_CREDENTIALS"] = "demonypchatbot.json";
    $_ENV["GOOGLE_CLOUD_PROJECT"] = "demonypchatbot";
    require "./vendor/autoload.php";

    $path = explode("/", $_GET["data"] ?? "home");
    $prog_path = strtolower($path[0]);
    $key_path = strtolower($path[1] ?? "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?=str_replace($_SERVER["DOCUMENT_ROOT"], "", str_replace("\\", "/", __DIR__))."/"?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIDM Content Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js"></script>
    <!-- <link href="http://sliptree.github.io/bootstrap-tokenfield/dist/css/bootstrap-tokenfield.css" rel="stylesheet"/> -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
</head>
<body>
    <div class="container">
        <?php include_once "template/nav/index.php";?>
        <?php include_once "template/main/index.php";?>
    </div>
</body>
</html>