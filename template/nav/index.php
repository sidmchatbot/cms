<nav>
    <img src="img/sidm-logo.png" alt="logo">
    <ul>
        <?php
            foreach(VALID_PATH as $k=>$v):
                if($k == "index"){continue;}
        ?>
        <li <?=$prog_path == $k ? "class='active'" : ""?> data-name="<?=$v;?>">
            <a href="<?=to_url_path($k)?>"><?=ucwords($k);?></a>
        </li>
        <?php endforeach;?>
    </ul>
</nav>