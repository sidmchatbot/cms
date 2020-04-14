<div class="courses">
    <div class="data header">
        <label class="checkbox"><input type="checkbox" name="course" class="course"></label>        
        <div class="name">Course</div>        
    </div>
    <?php
        $data = $GFirestore->page("nsa", $key_path, ["name"]);
        if(isset($_GET["search"])){
            $data = array_filter($data, function($v){
                $match = strtolower($_GET["search"]);
                $str = strtolower($v["name"]);
                if($match == ""){return true;}
                return strpos($str, $match) > -1;
            }, ARRAY_FILTER_USE_BOTH);
            
        }
        foreach($data as $d):
    ?>
        <div class="data">
            <label class="checkbox">
                <input type="checkbox" name="course[<?=$d["key"];?>]" class="course">
            </label>
            <a href="<?=str_replace(" ", "+", $prog_path).'/'.$d["key"];?>"><div class="name"><?=$d["name"];?></div></a>
        </div>
    <?php endforeach;?>
</div>