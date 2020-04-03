<?php 
    require_once "google/firestore/index.php";
    $path = __DIR__."\\".str_replace(" ", "_", $prog_path)."\\index.php";
?>
<div class="main-content">
    <?php if(file_exists($path)): # if file exists?>
        <?php if(is_numeric($key_path) || $key_path == ""): # if its main page?>
            <h1><?=$prog_path;?></h1>
            <div class="desc-cont">
                <h5>Program Description</h5>
                <form method="POST" action="process.php">
                    <textarea name="desc" class="desc" col="6" placeholder="Enter Your Program Description Here"></textarea>
                    <input type="hidden" name="doc" value="nsa">
                    <input type="submit" name="type" value="Save" class="btn"/>
                </form>
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
