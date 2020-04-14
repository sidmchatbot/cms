<h1><?=$prog_path?></h1>
<div class="desc-cont">
    <h5>Program Description</h5>
    <form method="POST" action="process.php?type=desc" data-prevent="true">
        <textarea name="desc" class="desc" col="6" placeholder="Enter Your Program Description Here" ><?=$GFirestore->doc("programme", VALID_PATH[$prog_path])->snapshot()->data()["description"]?></textarea>
        <input type="hidden" name="doc" value="<?=VALID_PATH[$prog_path]?>">
        <input type="submit" name="type" value="Save" class="btn"/>
    </form>
</div>
<div class="course-nav">
    <div class="controls">
        <a href="<?=to_url_path($prog_path);?>/add" value="Add" class="btn">Add</a>
        <input type="button" class="btn blk" value="Delete">
    </div>
    <div class="search">
        <form>
            <input type="text" name="search" value="<?=isset($_GET['search']) ? filter_var($_GET['search'],FILTER_SANITIZE_STRING) : ''?>"/>
            <input type="submit" class="btn" value="Search Course">
        </form>
    </div>
</div>
<div class="courses">
    <div class="data header">
        <label class="checkbox"><input type="checkbox" name="course" class="course"></label>        
        <div class="name">Course</div>        
    </div>
    <?php
        $data = $GFirestore->page(VALID_PATH[$prog_path], $key_path, ["name"]);
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
            <a href="<?=to_url_path($prog_path).'/'.$d["key"];?>"><div class="name"><?=$d["name"];?></div></a>
        </div>
    <?php endforeach;?>
</div>
<div class="pagination">
    <p><<</p>
    <?php for($i = 0; $i < ceil($GFirestore->total("course", "nsa")/10); $i++):?>
        <p class="<?=$i+1 == $key_path || $key_path == "" ? "active" : ""?>"><?=$i+1;?></p>
    <?php endfor; ?>
    <p>>></p>
</div>