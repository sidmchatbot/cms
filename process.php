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

    if($_GET["type"] == "desc"){
        $GFirestore->update("programme", $_POST["doc"], ["description"=>$_POST["desc"]]);
    }

    if($_GET["type"] == "delete"){
        for($i = 0; $i < count($_POST["course"]); $i++){
            $GFirestore->delete("course", $_POST["course"][$i]);
        }
    }

    if($_GET["type"] == "update"){
        $post = $_POST;
        unset($post["submit"]);
        unset($post["key"]);
        unset($post["redirect"]);

        $GFirestore->update("course", $_POST["key"], $post);
        header("Location: ".$_POST["redirect"]);
    }
?>