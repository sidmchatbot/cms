<?php
    require_once "./vendor/autoload.php";
    require_once "google/firestore/index.php";
    require_once "google/dialogflow/entities/index.php";
    
    use Google\Cloud\Core\Timestamp;

    $post = $_POST;

    switch($_GET["type"]){
        case "add" : 
            $course = $DialogflowEntities->entities("course");
            $tag = $DialogflowEntities->entities("tag");
            $post["duration"] = ["val"=>$post["duration"], "period"=>$post["duration-period"]];
            $post["program"] = $GFirestore->doc("programme", $post["program"]);
            $post["tokens"] = explode(",",$post["tokens"]);
            $post["date_added"] = new Timestamp(new DateTime());
            unset($post["duration-period"]);
            unset($post["key"]);
            unset($post["prev_name"]);
            unset($post["redirect"]);
            unset($post["submit"]);

            $GFirestore->insert("course", $post);
            $DialogflowEntities->val($course, $post["name"], [$post["name"]]);
            $DialogflowEntities->val($tag, $post["name"], $post["tokens"]);

            header("Location: ".$_POST["redirect"]);

        break;

        case "update" : 
            $course = $DialogflowEntities->entities("course");
            $tag = $DialogflowEntities->entities("tag");
            $post["program"] = $GFirestore->doc("programme", $post["program"]);
            $post["duration"] = ["val"=>$post["duration"], "period"=>$post["duration-period"]];
            $post["tokens"] = explode(",", $post["tokens"]);
            unset($post["duration-period"]);
            unset($post["submit"]);
            unset($post["redirect"]);
            unset($post["key"]);
            unset($post["prev_name"]);

            $DialogflowEntities->changeKeyName($tag, $_POST["prev_name"], $post["name"], $post["tokens"]);
            $DialogflowEntities->changeKeyName($course, $_POST["prev_name"], $post["name"], [$post["name"]]);
            $GFirestore->update("course", $_POST["key"], $post);

            header("Location: ".$_POST["redirect"]);
        break;

        case "desc" : 
            $GFirestore->update("programme", $_POST["doc"], ["description"=>$_POST["desc"]]);
        break;

        case "delete" : 
            $course = $DialogflowEntities->entities("course");
            $tag = $DialogflowEntities->entities("tag");
            
            for($i = 0;$i < count($post["course"]); $i++){
                $DialogflowEntities->delete($course, $post["course"][$i]["name"]);
                $DialogflowEntities->delete($tag, $post["course"][$i]["name"]);
                $GFirestore->delete("course", $post["course"][$i]["key"]);
            }
            echo json_encode($post["course"]);
        break;
    }
    // if($_GET["type"] == "delete"){
    //     for($i = 0; $i < count($_POST["course"]); $i++){
    //         $GFirestore->delete("course", $_POST["course"][$i]);
    //         $DialogflowEntities->delete("6f806756-f5d1-4905-9d25-815d40912e2b", $_POST["course_name"][$i]);
    //     }
    //     echo json_encode(["status"=>"finished"]);
    // }

?>