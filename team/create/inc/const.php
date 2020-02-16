<?php
    define("PAGETITLE","Pokemon Tournament");

    define("POKEDB","pokemonTournament");
    define("POKETABLE","pokeTeam");
    define("CONNHOST","localhost");
    define("CONNUSR","root");
    define("CONNPWD","");

    define("POKETABLEID","id");
    define("POKETABLENAME","name");

    define("UNDOBTN","Undo");

    define("CONNEXCEPTION","Error while trying to connect to DB");
    define("READEXCEPTION","Error while trying to read from DB");
    define("WRITEEXCEPTION","Error while trying to write DB");
    define("CREATEEXCEPTION","Error while trying to insert Team in DB");

    define("READOPERATION","read");
    define("CREATEOPERATION","create");
    define("DELETEOPERATION","delete");

    define("STARTPROCESSBTN","Start Process");
    define("TEAMLISTBTN","View Team List");
    define("TEAMEDITBTN","Team Edit");
    define("CREATENEWTEAMNAMEBTN","Create new Team");
    define("DELETETEAMBTN","Delete Team");
    define("CREATETEAMNAMEBTN","Submit Team Name");
    define("ADDPOKEMONBTN","Gotta Catch 'Em All");
    define("TEAMALREADYPRESENT","This team is already present in DB");

    define("ROOTPAGE","/");
    define("INCFOLDER",ROOTPAGE."inc/");
    define("ACTIONPAGE",INCFOLDER."action.php");

    define("APILINK","https://pokeapi.co/");
    define("APIPOKEMONLINK","api/v2/pokemon/");
?>