<?php
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
</head>
<body>
    <div class="container">
        <?php include_once "template/nav/index.php";?>
        <?php include_once "template/main/index.php";?>
    </div>
</body>
</html>