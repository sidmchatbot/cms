<?php
    //global variable

    require "./vendor/autoload.php";
    require "google/firestore/index.php";

    $_ENV["GOOGLE_APPLICATION_CREDENTIALS"] = "demonypchatbot.json";
    $_ENV["GOOGLE_CLOUD_PROJECT"] = "demonypchatbot";
    
    define("VALID_PATH", [
        "home"=>"home", 
        "index"=>"home", 
        "national silver academy"=>"nsa",
        "short course"=>"sc",
        "specialist diploma"=>"sd",
        "work study program"=>"wsp"
    ]);

    function to_url_path($link){
        return str_replace(" ", "+", $link);
    }
    $path = explode("/", $_GET["data"] ?? "home"); // get array of url path
    $prog_path = strtolower($path[0]); // get programme path
    $key_path = strtolower($path[1] ?? ""); // get optional path of update/add/id 
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
        <?php 
            // echo var_dump(array_search($prog_path, array_keys(VALID_PATH)));
            include_once "template/main/index.php";
        ?>
    </div>
</body>
</html>