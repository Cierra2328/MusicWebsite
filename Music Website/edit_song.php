<?php
//this file allows the user to edit a song
include("view/header.php");
require 'db.php';

    global $connection;
    $song_id = $_GET['song_id'];
    function get_song(){ //get song info
        global $connection;
        $song_id = $_GET['song_id'];
        $song_query = 'SELECT *
                            FROM songs 
                                JOIN albums ON songs.album_id = albums.album_id 
                                JOIN artists ON albums.artist_id = artists.artist_id
                                WHERE songs.song_id= :song_id';
        $statement = $connection->prepare($song_query);
        $statement->bindParam(':song_id', $song_id, PDO::PARAM_INT);
        $statement->execute([':song_id'=> $song_id]);
        $song_info = $statement->fetch(PDO::FETCH_OBJ);
        $statement->closeCursor();
        return $song_info;
    }
    if (
        isset($_POST['song_name'])  && isset($_POST['artist_name']) &&
        isset($_POST['album_name'])  && isset($_POST['length_in_seconds'])  &&
        isset($_POST['comments']) && isset($_POST['highest_billboard_ranking']) &&
        isset($_POST['date_of_billboard_ranking']) && isset($_POST['writer_name'])
    ) {
        //assign variables to post info
        $song_name = $_POST['song_name'];
        $stage_name = $_POST['artist_name'];
        $album_name = $_POST['album_name'];
        $length_in_seconds = $_POST['length_in_seconds'];
        $comments = !empty($_POST['comments']) ? $_POST['comments'] : NULL;
        $highest_billboard_ranking = !empty($_POST['highest_billboard_ranking']) ? $_POST['highest_billboard_ranking'] : NULL;
        $date_of_billboard_ranking = !empty($_POST['date_of_billboard_ranking']) ? $_POST['date_of_billboard_ranking'] : NULL;
        $writer_name = $_POST['writer_name'];
    
    $artist_id_query = 'SELECT artist_id FROM artists WHERE stage_name = :stage_name';
    $artist_statement = $connection->prepare($artist_id_query);
    $artist_statement->execute(['stage_name' => $stage_name]);
    $artist_object = $artist_statement->fetch(PDO::FETCH_OBJ);
    $artist_id = $artist_object->artist_id;
   
    $album_id_query = 'SELECT album_id FROM albums WHERE album_name = :album_name';
    $album_statement = $connection->prepare($album_id_query);
    $album_statement->execute(['album_name' => $album_name]);
    $album_object = $album_statement->fetch(PDO::FETCH_OBJ);

    $album_id = $album_object->album_id;
    $update_song = 'UPDATE songs SET song_name = :song_name, artist_id = :artist_id, album_id = :album_id, length_in_seconds = :length_in_seconds, comments = :comments, highest_billboard_ranking = :highest_billboard_ranking, date_of_billboard_ranking = :date_of_billboard_ranking, writer_name = :writer_name WHERE song_id = :song_id';

    $song_id=$_GET['song_id'];
    $statement = $connection->prepare($update_song);
    $statement->execute([':song_name' => $song_name, ':artist_id' => $artist_id, ':album_id' => $album_id, ':length_in_seconds' => $length_in_seconds, ':comments' => $comments, ':highest_billboard_ranking' => $highest_billboard_ranking, ':date_of_billboard_ranking' => $date_of_billboard_ranking, ':writer_name' => $writer_name, ':song_id' => $song_id]);
    $new_song = $statement->fetch(PDO::FETCH_OBJ);
    header('Location: view_song.php?song_id=' . $song_id);      
    }      



    function get_all_artists() //get artist info
{
    global $connection;
    $artist_query = 'SELECT DISTINCT stage_name, artists.artist_id, album_name, album_id
                        FROM artists JOIN albums on artists.artist_id = albums.album_id';
    $statement = $connection->prepare($artist_query);
    $statement->execute();
    $artists = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $artists;
}
$artists = get_all_artists();
$song_info = get_song();

?>

<div class="body-add">
<div class = "body">
<h1><a href="view_song.php?song_id=<?= $song_info->song_id; ?>" title = "Back to Song Details"><svg class = "icons-back" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
</svg></a>Edit Song <div class= "space-header"></div></h1>
    <label class= "details-label"></label>
   <form method = 'post'>
    <table class = "add">
    <tr>
        <!-- gather and display current song info and allow user to edit it-->
        <td class = "label-2">Song Name</td><td><input type = "text" name = "song_name" value = "<?= $song_info->song_name; ?>" class = "textbox" required></td>
        </tr>
        <tr>
        <td>Artist Name</td><td><select class = "drop-down" name = "artist_name"> <?php foreach($artists as $artist): if($artist->artist_id == $song_info->artist_id){?> <option value = "<?php echo $song_info->stage_name ?>" selected><?php echo $artist->stage_name; ?></option><?php } else{ ?>
        <option value = "<?php echo $artist->artist_id ?>"><?php echo $artist->stage_name ?><?php } endforeach;?></td>
        </tr>
        <tr>
        <td>Album Name</td><td><select class = "drop-down" name = "album_name" ><?php foreach($artists as $artist): if($artist->album_id == $song_info->album_id){?> <option value = "<?php echo $song_info->album_name ?>" selected><?php echo $artist->album_name; ?></option><?php } else{ ?>
        <option value = "<?php echo $artist->album_id ?>"><?php echo $artist->album_name ?><?php } endforeach;?></td>
        <tr><td>Length in Seconds</td><td><input type = "text" name = "length_in_seconds" value = "<?=$song_info->length_in_seconds?>" class = "textbox" required></td></tr>
        <tr><td>Highest Billboard Ranking</td><td><input type = "text" name = "highest_billboard_ranking" value = "<?=$song_info->highest_billboard_ranking?>" class = "textbox"></td></tr>
        <tr><td>Billboard Ranking Date</td><td><input type = "text" name = "date_of_billboard_ranking" value = "<?=$song_info->date_of_billboard_ranking?>" class = "textbox"></td></tr>
        <tr><td>Songwriter(s)</td><td><input type = "text" name = "writer_name" value = "<?=$song_info->writer_name?>" class = "textbox" required></td></tr>
        <tr><td>Comments</td><td><textarea name = "comments"><?php echo $song_info->comments;?></textarea></td></tr>
        <tr><td class = "button"><button type = "submit">Update Song</button></td>
        </form>
</table>
        </div>
</div>


<?php include("view/footer.php");?>