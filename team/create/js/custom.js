function checkBodyDim(){
    $('#pageContainer').css('height',window.innerHeight * 0.95);
    $('#pageContainer').css('margin-top',(window.innerHeight - $('#pageContainer').height())*0.3);
}
$(window).on('load',function(){checkBodyDim();});
$(window).on('resize',function(){checkBodyDim();});

$('#startBtn').on('click',function(){$('#act').val('start');});
//$('#teamListBtn').on('click',function(){$('#act').val('teamList');});
$('#teamCreationBtn').on('click',function(){$('#act').val('teamCreation');});
$('#addPokemonBtn').on('click',function(){document.location.href="index.php?act=addPokemonAction";});
$('#reloadPokemon').on('click',function(){document.location.href="index.php?act=addPokemonAction";});
$('.undoBtn').on('click',function(){document.location.href="index.php";});
$('#teamDeleteBtn').on('click',function(){$('#teamNameText').val($('#teamDeleteBtn').attr('teamName'));$('#act').val('teamDeletion');$('#deletionTeamName').val($('#teamDeleteBtn').attr('teamName'));});
$('#createTeamBtn').on('click',function(){document.location.href="team/create/index.php";});
$('#teamListBtn').on('click',function(){document.location.href="team/list/index.php";});
$('#teamEditBtn').on('click',function(){document.location.href="team/edit/index.php";});