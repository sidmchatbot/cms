<?php 
    require_once "google/firestore/index.php";
    $naming = [
        "national silver academy"=>"nsa",
        "specialist diploma"=>"sd",
        "short course"=>"sc",
        "work study program"=>"wsp",
    ];
    $path = __DIR__."\\".str_replace(" ", "_", $prog_path)."\\index.php";
?>
<div class="main-content">
    <?php if(file_exists($path)): # if file exists?>
        <?php if(is_numeric($key_path) || $key_path == ""): # if its main page?>
            <h1><?=$prog_path;?></h1>
            <div class="desc-cont">
                <h5>Program Description</h5>
                <form method="POST" action="process.php?type=desc" data-prevent='true'>
                    <textarea name="desc" class="desc" col="6" placeholder="Enter Your Program Description Here" ><?=$GFirestore->doc("programme", $naming[$prog_path])->snapshot()->data()["description"]?></textarea>
                    <input type="hidden" name="doc" value="<?=$naming[$prog_path]?>">
                    <input type="submit" name="type" value="Save" class="btn"/>
                </form>
            </div>   
            <div class="course-nav">
                <div class="controls">
                    <a href="<?=str_replace(" ", "+",$prog_path);?>/add" value="Add" class="btn">Add</a>
                    <input type="button" class="btn blk" value="Delete">
                </div>
                <div class="search">
                    <form>
                        <input type="text" name="search" value="<?=isset($_GET['search']) ? filter_var($_GET['search'],FILTER_SANITIZE_STRING) : ''?>"/>
                        <input type="submit" class="btn" value="Search Course">
                    </form>
                </div>
            </div> 
            <?php require_once $path; ?>
            <div class="pagination">
                <p><<</p>
                <?php for($i = 0; $i < ceil($GFirestore->total("course", "nsa")/10); $i++):?>
                    <p class="<?=$i+1 == $key_path || $key_path == "" ? "active" : ""?>"><?=$i+1;?></p>
                <?php endfor; ?>
                <p>>></p>
            </div>
        <?php else:?>
            <?php require_once __DIR__."\\add\\index.php";?>
        <?php endif;?>
    <?php else: #if file does not exists?>
        <?php require_once __DIR__."\\404\\index.php";?>
    <?php endif;?>
