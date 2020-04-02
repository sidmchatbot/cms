<?php 
    $path = __DIR__."\\".str_replace(" ", "_", $prog_path)."\\index.php";
?>
<div class="main-content">
    <?php if($key_path == ""):?>
        <?php if(file_exists($path)): ?>
            <h1><?=$prog_path;?></h1>
            <div class="desc-cont">
                <h5>Program Description</h5>
                <form method="POST" action="process.php">
                    <textarea name="desc" class="desc" col="6" placeholder="Enter Your Program Description Here"></textarea>
                    <input type="hidden" name="doc" value="nsa">
                    <input type="submit" name="type" value="Save" class="btn"/>
                </form>
            </div>
            <?php require_once $path;?>
        <?php else : require_once __DIR__."\\404\\index.php";?>
        <?php endif;?>
    <?php else:?>
        <?php
            # the keypath add and key can be added together
        ?>
        <?php if($key_path == "add"):?>
            <?php require_once __DIR__."\\add\\index.php"; ?>
        <?php else:?>
            Key
        <?php endif;?>
    <?php endif;?>
</div>