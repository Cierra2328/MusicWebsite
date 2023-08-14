<?php
//this file allows the user to edit an artist
include("view/header.php");
require 'db.php';
if (
    isset($_POST['stage_name'])  && isset($_POST['birth_name']) &&
    isset($_POST['date_of_birth'])  && isset($_POST['hometown'])  &&
    isset($_POST['date_of_death']) && isset($_POST['fun_fact'])
) {
    //assign variables to post 
    $birth_name = $_POST['birth_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_death = !empty($_POST['date_of_death']) ? $_POST['date_of_death'] : NULL;
    $hometown = !empty($_POST['hometown']) ? $_POST['hometown'] : NULL;
    $stage_name = !empty($_POST['stage_name']) ? $_POST['stage_name'] : NULL;
    $fun_fact = $_POST['fun_fact'];
    $artist_id = $_GET['artist_id'];
    $update_artist_query = 'UPDATE artists SET stage_name = :stage_name, birth_name = :birth_name, date_of_birth = :date_of_birth, hometown = :hometown, date_of_death = :date_of_death, fun_fact = :fun_fact
                            WHERE artist_id = :artist_id'; 
    $statement = $connection->prepare($update_artist_query);
    $statement->execute([':stage_name' => $stage_name, ':birth_name' => $birth_name, ':date_of_birth' => $date_of_birth, ':hometown' => $hometown, ':date_of_death' => $date_of_death, ':fun_fact' => $fun_fact, ':artist_id' => $artist_id]);
    $artist = $statement->fetch(PDO::FETCH_OBJ); 
    header('Location: all_artists.php');
}
function get_artist(){ //get artist info
    global $connection;
    $artist_id = $_GET['artist_id'];
    $artist_query = 'SELECT *
                    FROM artists
                    WHERE artist_id = :artist_id';
    $statement = $connection->prepare($artist_query);
    $statement->execute([':artist_id'=>$artist_id]);
    $artists = $statement->fetch(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $artists;
}
$artist = get_artist();

?>

<div class="body-add">
    <div class = "body">
    <h1><a href="view_artist.php?artist_id=<?= $artist->artist_id; ?>"  title="Back to Artist Details"><svg class = "icons-back" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
</svg></a>Edit Artist <div class= "space-header"></div></h1>
    <label class= "details-label"></label>
   <form method="post">
    <table class = "add">
    <tr> <!-- displays current artist info -->
        <td class = "label-2">Stage Name</td><td><input type = "text" name = "stage_name" value = "<?= $artist->stage_name; ?>"class = "textbox"></td>
        </tr>
        <tr>
        <td>Birth Name</td><td><input type = "text" name = "birth_name" value="<?= $artist->birth_name;?>"class = "textbox" required></td>
        </tr>
        <tr>
        <td>Date of Birth</td><td><input type = "date" name = "date_of_birth" value="<?=$artist->date_of_birth;?>"class = "textbox" required></td>
        </tr>
        <tr><td>Hometown</td><td><input type = "text" name = "hometown" value = "<?=$artist->hometown;?>" class = "textbox"></td></tr>
        <tr><td>Date of Death</td><td><input type = "date" name = "date_of_death" value = "<?=$artist->date_of_death;?>" class = "textbox"><span title="Date of Death may be left blank"><svg style="padding-left:1em;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></span></svg></td></tr>
        <tr><td>Notable Fact</td><td><textarea name = "fun_fact" required><?php echo $artist->fun_fact;?></textarea></td></tr>
        <tr><td class = "button"><button type = "submit">Update Artist</button></td></tr>
</form>
</table>
</div>
</div>


<?php include("view/footer.php");?>