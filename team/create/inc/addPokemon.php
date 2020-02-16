<?php
    $teamNames = $pokeMan->readTable($conn,POKETABLE,array(POKETABLEID,POKETABLENAME),1);
    $lastTeam = array_pop($teamNames);
    $lastTeamName = isset($lastTeam["".POKETABLENAME.""]) ? trim($lastTeam["".POKETABLENAME.""]) : "";
?>
<input type="text" id="teamNameText" name="teamNameText" class="formField" value="<?php echo $lastTeamName; ?>" disabled /><hr />
<button type="button" class="btn btn-success" id="addPokemonBtn" name="addPokemonBtn" value=""><?php echo ADDPOKEMONBTN; ?></button>
<button type="button" class="btn btn-danger undoBtn" id="addPokemonUndoBtn" name="addPokemonUndoBtn" value="">Undo</button>