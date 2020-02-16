<?php 
    if(empty($teamNames)){echo"No Teams are present in list yet";}
    else{
        echo"Present Team names:<hr />";
        foreach($teamNames as $t){
            $name = isset($t["".POKETABLENAME.""]) ? trim($t["".POKETABLENAME.""]) : "";
            if($name){
?>
        <li>
            <?php echo $name; ?><button type="submit" class="btn btn-danger" id="teamDeleteBtn" name="teamDeleteBtn" teamName="<?php echo $name; ?>" value=""><?php echo DELETETEAMBTN; ?></button>
        </li>
<?php
            }
        }
    }
?>