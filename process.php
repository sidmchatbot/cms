<?php
    require_once "./vendor/autoload.php";
    require_once "google/firestore/index.php";
    require_once "google/dialogflow/entities/index.php";
    
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
            "date_added"=>new Timestamp(new DateTime()),
            "tokens"=>explode(",", $_POST["tokens"])
        ]);
        $DialogflowEntities->entity("6f806756-f5d1-4905-9d25-815d40912e2b", $_POST["name"], explode(",", $_POST["tokens"]));
        header("Location: ".$_POST["redirect"]);
    }

    if($_GET["type"] == "desc"){
        $GFirestore->update("programme", $_POST["doc"], ["description"=>$_POST["desc"]]);
    }

    if($_GET["type"] == "delete"){
        for($i = 0; $i < count($_POST["course"]); $i++){
            $GFirestore->delete("course", $_POST["course"][$i]);
            $DialogflowEntities->delete("6f806756-f5d1-4905-9d25-815d40912e2b", $_POST["course_name"][$i]);
        }
        echo json_encode(["status"=>"finished"]);
    }

    if($_GET["type"] == "update"){
        $post = $_POST;
        unset($post["submit"]);
        unset($post["key"]);
        unset($post["redirect"]);
        $post["tokens"] = explode(",",$_POST["tokens"]);
        $GFirestore->update("course", $_POST["key"], $post);
        $DialogflowEntities->entity("6f806756-f5d1-4905-9d25-815d40912e2b", $post["name"], $post["tokens"]);
        header("Location: ".$_POST["redirect"]);
    }
?>