<?php
    $pokemonID = rand(0,100);
    $url = APILINK.APIPOKEMONLINK.$pokemonID;
    if ( !$result = file_get_contents($url)) throw new Exception('Unable to load '.$url);
    if ( !$resultArray = json_decode($result)) throw new Exception('Unable to decode JSON:<br>'.$result);

    $pokemonName = (!empty($resultArray->name)) ? "<b>".trim($resultArray->name)."</b>" : "";

    $spritesValues = (!empty($resultArray->abilities)) ? $resultArray->sprites : "";
    $spriteFrontDefault = isset($spritesValues->front_default) ? "<img src='".$spritesValues->front_default."' class='spriteImage' />" : "";
    $spriteFrontFemale = isset($spritesValues->front_female) ? "<img src='".$spritesValues->front_female."' class='spriteImage' />" : "";
    $spriteFrontShiny = isset($spritesValues->front_shiny) ? "<img src='".$spritesValues->front_shiny."' class='spriteImage' />" : "";
    $spriteFrontShinyFemale = isset($spritesValues->front_shiny_female) ? "<img src='".$spritesValues->front_shiny_female."' class='spriteImage' />" : "";
    $spriteBackDefault = isset($spritesValues->back_default) ? "<img src='".$spritesValues->back_default."' class='spriteImage' />" : "";
    $spriteBackFemale = isset($spritesValues->back_female) ? "<img src='".$spritesValues->back_female."' class='spriteImage' />" : "";
    $spriteBackShiny = isset($spritesValues->back_shiny) ? "<img src='".$spritesValues->back_shiny."' class='spriteImage' />" : "";
    $spriteBackShinyFemale = isset($spritesValues->back_shiny_female) ? "<img src='".$spritesValues->back_shiny_female."' class='spriteImage' />" : "";
    $spriteImageValue = $spriteFrontDefault."&nbsp;".$spriteFrontFemale."&nbsp;".$spriteFrontShiny."&nbsp;".$spriteFrontShinyFemale."&nbsp;".$spriteBackDefault."&nbsp;".$spriteBackFemale."&nbsp;".$spriteBackShiny."&nbsp;".$spriteBackShinyFemale;

    $pokemonAbilities = (!empty($resultArray->abilities)) ? $resultArray->abilities : "";
    $abilitiesArray = $abilities = [];
    if(!empty($pokemonAbilities)){
        foreach($pokemonAbilities as $ab){
            $abName = isset($ab->ability->name) ? trim($ab->ability->name) : "";
            $abLink = isset($ab->ability->url) ? trim($ab->ability->url) : "";
            $abVisible = (isset($ab->is_hidden) && $ab->is_hidden) ? false : true;
            $abilitiesArray[] = array($abName,$abLink,$abVisible);
        }
    }
    if(!empty($abilitiesArray)){
        foreach($abilitiesArray as $a){
            $visibility = (isset($a[2]) && $a[2]) ? "Visible" : "Hidden";
            $abilities[] = ( (!empty($a)) && (isset($a[0])) && (isset($a[1])) && (isset($a[2])) ) ? "&nbsp;&nbsp;&nbsp;<b>".$a[0]."</b>(<a href='".$a[1]."' target='_blank'>".$a[1]."</a>) - <i>".$visibility."</i>" : "";
        }
    }
    $abilitiesValue = implode("<br />",$abilities);

    $pokemonTypes = (!empty($resultArray->types)) ? $resultArray->types : "";
    $typeArrayValues = [];
    if(!empty($pokemonTypes)){
        foreach($pokemonTypes as $pt){
            $typeName = isset($pt->type->name) ? "<b>".trim($pt->type->name)."</b>" : "";
            $typeUrl = isset($pt->type->url) ? "<a href='".trim($pt->type->url)."' target = '_blank'>".trim($pt->type->url)."</a>" : "";
            $typeArrayValues[] = $typeName."(".$typeUrl.")";
        }
    }
    $typesValue = implode("<br />",$typeArrayValues);
?>
<div id="pokemonDataTable" class="resultTable">
    <div class="resultTr">
        <div class="resultTd resultTdTitle resultTdName">Name</div>
        <div class="resultTd resultTdTitle resultTdImage">Sprite Image</div>
        <div class="resultTd resultTdTitle resultTdAbilities">Abilities</div>
        <div class="resultTd resultTdTitle resultTdTypes">Types</div>
    </div>
    <div class="clearBoth"></div>
    <div class="resultTr resultTrVal">
        <div class="resultTd resultTdVal resultTdName resultTdNameVal"><?php echo $pokemonName; ?></div>
        <div class="resultTd resultTdVal resultTdImage resultTdImageVal"><?php echo $spriteImageValue; ?></div>
        <div class="resultTd resultTdVal resultTdAbilities resultTdAbilitiesVal"><?php echo $abilitiesValue; ?></div>
        <div class="resultTd resultTdVal resultTdTypes resultTdTypesVal"><?php echo $typesValue; ?></div>
    </div>
    <div class="clearBoth"></div>
</div>
<hr />
<button type="button" class="btn btn-success" id="reloadPokemon" name="reloadPokemon" value="">Reload</button>
<button type="button" class="btn btn-danger undoBtn" id="addPokemonUndoBtn" name="addPokemonUndoBtn" value="">Undo</button>