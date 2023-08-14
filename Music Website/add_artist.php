<?php
//this file adds an artist to the databse
include("view/header.php");
require 'db.php';
//this checks that the form was filled out and posted correctly
if (
    isset($_POST['stage_name'])  && isset($_POST['birth_name']) &&
    isset($_POST['date_of_birth'])  && isset($_POST['hometown'])  &&
    isset($_POST['date_of_death']) && isset($_POST['fun_fact'])
) {
    //assigning the post to variables
    $birth_name = $_POST['birth_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_death = !empty($_POST['date_of_death']) ? $_POST['date_of_death'] : NULL;
    $hometown = !empty($_POST['hometown']) ? $_POST['hometown'] : NULL;
    $stage_name = !empty($_POST['stage_name']) ? $_POST['stage_name'] : NULL;
    $fun_fact = $_POST['fun_fact'];

    //query and replacing the values with the variables
    $add_artist_query = 'INSERT INTO artists (stage_name, birth_name, date_of_birth, hometown, date_of_death, fun_fact) 
    VALUES (:stage_name, :birth_name, :date_of_birth, :hometown, :date_of_death, :fun_fact)';
    $statement = $connection->prepare($add_artist_query);
    $statement->execute([':stage_name' => $stage_name, ':birth_name' => $birth_name, ':date_of_birth' => $date_of_birth, ':hometown' => $hometown, ':date_of_death' => $date_of_death, ':fun_fact' => $fun_fact]);
    $new_artist = $statement->fetch(PDO::FETCH_OBJ); 
    header('Location: all_artists.php');
}

?>

<div class="body-add">
    <div class = "body">
        <!-- h1 has button taking user back to the all artists page -->
    <h1><a href="all_artists.php"  title="Back to All Artists"><svg class = "icons-back" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
</svg></a>Add Artist <div class= "space-header"></div></h1>
    <label class= "details-label"></label>
   <form method="post">
    <table class = "add">
    <tr>
        <td class = "label-2">Stage Name</td><td><input type = "text" name = "stage_name" class = "textbox"></td>
        </tr>
        <tr>
        <td>Birth Name</td><td><input type = "text" name = "birth_name" class = "textbox" required></td>
        </tr>
        <tr>
        <td>Date of Birth</td><td><input type = "date" name = "date_of_birth" class = "textbox" required></td>
        </tr>
        <tr><td>Hometown</td><td><input type = "text" name = "hometown" value = "" class = "textbox"></td></tr>
        <tr><td>Date of Death</td><td><input type = "date" name = "date_of_death" value = "" class = "textbox"><span title="Date of Death may be left blank"><svg style="padding-left:1em;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></span></svg></td></tr>
        <tr><td>Notable Fact</td><td><textarea name = "fun_fact"></textarea></td></tr>
        <tr><td class = "button"><button type = "submit">Add Artist</button></td></tr>
</form>
</table>
</div>
</div>


<?php include("view/footer.php");?>