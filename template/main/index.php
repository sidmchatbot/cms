<div class="main-content">
    <?php 
        if(array_search($prog_path, array_keys(VALID_PATH)) > -1 && $prog_path !== "home"):
            if($key_path == ""):
                require_once __DIR__."/get/index.php";
            else:
                require_once __DIR__."/edit/index.php";
            endif;
    ?>
    <?php
        else:
            require_once __DIR__."/404/index.php";
        endif;
    ?>
</div>