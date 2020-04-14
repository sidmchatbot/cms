<?php
    $doc = $GFirestore->doc("course", $key_path);
    $mode = $key_path == "add" ? "add" : "update";
    $data = $doc->snapshot()->exists() ? $GFirestore->to_array([$doc->snapshot()], ["*"])[0] : [];

    $course = array_unique(VALID_PATH);
    array_shift($course);
    if(!$doc->snapshot()->exists() && $mode != "add"){
        require_once "template/main/404/index.php";
        exit();
    }
?>
<h1 class="add-h1"><?=$mode?> Course</h1>
<form action="process.php?type=<?=$mode;?>" method="POST" data-prevent="false" class="add-edit">
    <div class="controls">
        <input type="submit" name="submit" class="btn"/>
    </div>
    <div class="left">
        <h5>Information</h5>
        <hr>
        <label for="name">
            <p>Name </p>
            <input type="text" name="name" id="name" placeholder="Enter Course Name" value="<?=$data["name"] ?? "";?>">
        </label>
        <label for="program">
            <p>Program</p>
            <select name="program" id="program">
                <option disabled <?=$mode == "add" ? "selected" : ""?>>Select Course</option>
                <?php foreach($course as $k=>$v):?>
                    <option value="<?=$v?>" <?= $prog_path == $k && $mode == "update" ? "selected" : "" ?>><?=ucwords($k)?></option>
                <?php endforeach;?>
            </select>
        </label>
        <label for="description">
            <p>Description </p>
            <textarea rows=10 name="description" id="description" placeholder="Type in the description of the course"><?=$data["description"] ?? "";?></textarea>
        </label>
        <label for="tokenfield">
            <p>Keyword</p>
            <input id="tokenfield" value="<?=isset($data["tokens"]) ? implode(",", $data["tokens"]) : ""?>"/>
            <input type="hidden" id="all-tokens" name="tokens" value="<?=isset($data["tokens"]) ? implode(",", $data["tokens"]) : ""?>"/>
        </label>
        <h5>Timing</h5>
        <hr>
        <label for="duration">
            <p>Duration </p>
            <div class="split-content">
                <input type="number" id="duration" name="duration" min="1" max="12" value="<?=$data["duration"]["val"] ?? ""?>"/>
                <select id="duration-period" name="duration-period">
                    <?php
                        $option = [
                            "Hour",
                            "Day", 
                            "Month",
                            "Year"
                        ];
                        foreach($option as $d){
                            echo "<option value=".strtolower($d)." ".(strtolower($d) == $data["duration"]["period"] ? "selected" : "").">$d</option>";
                        }
                    ?>
                </select>
            </div>
        </label>
        <div class="split-content">
            <label for="registration">
                <p>Registration Date </p>
                <input type="date" name="registration" id="registration" value="<?=$data["registration"] ?? "";?>"/>
            </label> 
            <label for="start">
                <p>Commencement Date </p>
                <input type="date" name="start" id="start" value="<?=$data["start"] ?? "";?>"/>
            </label> 
        </div>
    </div>
    <div class="right">
        <h5>Entry Requirement</h5>
        <hr>
        <label for="requirement">
            <p>Requirement</p>
            <textarea name="requirement" id="requirement" rows="10"><?=$data["requirement"] ?? "" ?></textarea>
        </label>
        <label for="fees">
            <p>Fees</p>
            <input type="text" name="fees" id="fees" disabled value="Fee will be added in due time">
        </label>
    </div>
    <input type="hidden" name="redirect" value="<?=to_url_path($prog_path)?>"/>
    <input type="hidden" name="key" value="<?=$key_path == "add" ? "" : $key_path;?>"/>
    <input type="hidden" name="prev_name" value="<?=$data["name"] ?? ""?>"/>
</form>