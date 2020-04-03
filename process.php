<?php
    require_once "./vendor/autoload.php";
    require_once "google/firestore/index.php";
    
    use Google\Cloud\Core\Timestamp;

    if($_GET["type"] == "add"){ // adding courses
        $GFirestore->insert("course", [
            "name"=>$_POST["name"],
            "description"=>$_POST["description"],
            "duration"=>[
                "val"=>$_POST["duration"],
                "period"=>$_POST["duration-period"]
            ],
            "program"=>$GFirestore->doc("programme", $_POST["program"]),
            "registration"=>$_POST["registration"],
            "start"=>$_POST["start"],
            "requirement"=>$_POST["requirement"],
            "date_added"=>new Timestamp(new DateTime())
        ]);
        header("Location: ".$_POST["redirect"]);
    }

    header("Content-Type:application/json");
?>