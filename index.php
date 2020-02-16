<?php
    include'team/create/inc/const.php';
?>
<html>
    <head>
        <title>Pokemon Exercise</title>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="team/create/css/custom.css" />
    </head>
    <body>
        <div id="pageContainer" class="pageContainer">
            <div id="pageTitleDiv" class="sectionDiv"><?php echo PAGETITLE; ?></div>
            <div id="startDiv" class="fomDiv">
                <button type="button" class="btn btn-info" id="createTeamBtn" name="createTeamBtn" value=""><?php echo CREATENEWTEAMNAMEBTN; ?></button>
                <button type="button" class="btn btn-info" id="teamListBtn" name="teamListBtn" value=""><?php echo TEAMLISTBTN; ?></button>
                <button type="button" class="btn btn-info" id="teamEditBtn" name="teamEditBtn" value=""><?php echo TEAMEDITBTN; ?></button>
            </div>
        </div>
    </body>
</html>
<script src='team/create/js/custom.js'></script>