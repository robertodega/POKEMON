<?php
    include'inc/const.php';
    include'inc/conn.php';
    include'inc/class.php';
    
    $pokeMan = new pokeMan();

    $act = isset($_REQUEST["act"]) ? $_REQUEST["act"] : "";

    $conn = $pokeMan->tryConn();

    $teamNames = $pokeMan->readTable($conn,POKETABLE,array(POKETABLEID,POKETABLENAME),1);
?>
<html>
    <head>
        <title><?php echo PAGETITLE; ?></title>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/custom.css" />
    </head>
    <body>
        <div id="pageContainer" class="pageContainer">
            <div id="pageTitleDiv" class="sectionDiv"><?php echo PAGETITLE; ?></div>
<?php 
    if(!$act){ 
?>
            <div class="formDiv" id="formStartDiv">
                <form id='pokeForm' method="post" action="#">
                    <input type="hidden" id="act" name="act" value="" placeholder="act" />
                    <input type="hidden" id="deleteTeamField" name="deleteTeamField" value="" placeholder="deleteTeamField" />
                    <div id="startDiv" class="fomDiv">
                        <button type="submit" class="btn btn-info" id="startBtn" name="startBtn" value=""><?php echo STARTPROCESSBTN; ?></button>
                    </div>
                </form>
            </div>
<?php 
    } 
    else{
        $teamCreationDisplay = "block";
        $teamListDisplay = $addPokemonDisplay = $pokemonCreationDisplay = "none";
        switch($act){
            case'start':{
                
            }break;
            case'teamList':{
                $teamListDisplay = "block";
            }break;
            case'teamCreation':{
                $teamCreationDisplay = "none";
                $addPokemonDisplay = "block";

                $canInsert = true;
                $errMsg = "";

                $teamNameText = isset($_POST["teamNameText"]) ? $_POST["teamNameText"] : "";

                $teamNames = $pokeMan->readTable($conn,POKETABLE,array(POKETABLEID,POKETABLENAME),1);

                $lastTeamName = "";
                if(!empty($teamNames)){
                    $lastTeam = array_pop($teamNames);
                    $lastTeamName = isset($lastTeam["".POKETABLENAME.""]) ? trim($lastTeam["".POKETABLENAME.""]) : "";
                }

                foreach($teamNames as $tn){
                    $curName = isset($tn["".POKETABLENAME.""]) ? trim($tn["".POKETABLENAME.""]) : "";
                    if($curName == $teamNameText){
                        $canInsert = false;
                        $errMsg = TEAMALREADYPRESENT;
                        break;
                    }
                }

                if($canInsert){
                    $insertTeamNames = $pokeMan->writeTable($conn,POKETABLE,array(POKETABLENAME),$teamNameText);

                    $teamNames = $pokeMan->readTable($conn,POKETABLE,array(POKETABLEID,POKETABLENAME),1);
                    $lastTeam = array_pop($teamNames);
                    $lastTeamName = isset($lastTeam["".POKETABLENAME.""]) ? trim($lastTeam["".POKETABLENAME.""]) : "";
                }
                else{ ?><div id="teamCreationErrorDiv" class="errDiv"><?php echo $errMsg; ?></div><?php }
            }break;
            case'addPokemonAction':{
                $teamCreationDisplay = "none";
                $pokemonCreationDisplay = "block";
            }break;
            case'teamDeletion':{
                $teamToDelete = isset($_POST["deletionTeamName"]) ? $_POST["deletionTeamName"] : "";
                $deleteTeam = $pokeMan->deleteTeam($conn,POKETABLE,array(POKETABLENAME),$teamToDelete);
            }break;
            default:{}break;
        }
?>
            <form id='pokeForm' method="post" action="#">
                <input type="hidden" id="act" name="act" value="<?php echo $act; ?>" placeholder="act" />
                <input type="hidden" id="deletionTeamName" name="deletionTeamName" />
                <div id="createTeamDiv" class="fomDiv" style="display:<?php echo $teamCreationDisplay; ?>"><?php include'inc/teamCreation.php'; ?></div>
                <div id="teamListDiv" class="fomDiv" style="display:<?php echo $teamListDisplay; ?>"><?php include'inc/teamList.php'; ?></div>
                <div id="addPokemonDiv" class="fomDiv" style="display:<?php echo $addPokemonDisplay; ?>"><?php include'inc/addPokemon.php'; ?></div>
                <div id="pokemonCreationDiv" class="fomDiv" style="display:<?php echo $pokemonCreationDisplay; ?>"><?php include'inc/pokemonCreation.php'; ?></div>
            </form>
<?php
    }
?>
        </div>
    </body>
</html>
<script src='js/custom.js'></script>