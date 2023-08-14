<?php
//this file allows the user to add a song to the database
include("view/header.php");
require 'db.php';

    global $connection;
    if (
        isset($_POST['song_name'])  && isset($_POST['artist_name']) &&
        isset($_POST['album_name'])  && isset($_POST['length_in_seconds'])  &&
        isset($_POST['comments']) && isset($_POST['highest_billboard_ranking']) &&
        isset($_POST['date_of_billboard_ranking']) && isset($_POST['writer_name'])
    ) {
        $song_name = $_POST['song_name'];
        $stage_name = $_POST['artist_name'];
        $album_name = $_POST['album_name'];
        $length_in_seconds = $_POST['length_in_seconds'];
        $comments = !empty($_POST['comments']) ? $_POST['comments'] : NULL;
        $highest_billboard_ranking = !empty($_POST['highest_billboard_ranking']) ? $_POST['highest_billboard_ranking'] : NULL;
        $date_of_billboard_ranking = !empty($_POST['date_of_billboard_ranking']) ? $_POST['date_of_billboard_ranking'] : NULL;
        $writer_name = $_POST['writer_name'];
    //theres a better way to do whats below this comment, but it works 
        //matching the artist so we update the right one
    $artist_id_query = 'SELECT artist_id FROM artists WHERE stage_name = :stage_name';
    $artist_statement = $connection->prepare($artist_id_query);
    $artist_statement->execute(['stage_name' => $stage_name]);
    $artist_object = $artist_statement->fetch(PDO::FETCH_OBJ);
    $artist_id = $artist_object->artist_id;
   
    //matching album to album name so we update it 
    $album_id_query = 'SELECT album_id FROM albums WHERE album_name = :album_name';
    $album_statement = $connection->prepare($album_id_query);
    $album_statement->execute(['album_name' => $album_name]);
    $album_object = $album_statement->fetch(PDO::FETCH_OBJ);

    $album_id = $album_object->album_id;
    $add_song_query = 'INSERT INTO songs (song_name, artist_id, album_id, length_in_seconds, comments, highest_billboard_ranking, date_of_billboard_ranking, writer_name) 
                    VALUES (:song_name, :artist_id, :album_id, :length_in_seconds, :comments, :highest_billboard_ranking, :date_of_billboard_ranking, :writer_name)';
    $statement = $connection->prepare($add_song_query);
    $statement->execute([':song_name' => $song_name, ':artist_id' => $artist_id, ':album_id' => $album_id, ':length_in_seconds' => $length_in_seconds, ':comments' => $comments, ':highest_billboard_ranking' => $highest_billboard_ranking, ':date_of_billboard_ranking' => $date_of_billboard_ranking, ':writer_name' => $writer_name]);
    $new_song = $statement->fetch(PDO::FETCH_OBJ); 
    header('Location: view_album.php?album_id='. $album_id);      
    }      



    function get_all_artists() //get artist info 
{
    global $connection;
    $artist_query = 'SELECT DISTINCT stage_name, artist_id, birth_name
                    FROM artists';
    $statement = $connection->prepare($artist_query);
    $statement->execute();
    $artists = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $artists;
}
function get_albums(){ //get album info
    global $connection;
    $album_query = 'SELECT DISTINCT album_name, album_id
                    FROM albums';
    $statement = $connection->prepare($album_query);
    $statement->execute();
    $albums = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $albums;
}
$artists = get_all_artists();
$albums = get_albums();
?>

<div class="body-add">
<div class = "body">
<h1><a href="all_songs.php"><svg class = "icons-back" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
</svg></a>Add Song <div class= "space-header"></div></h1>
    <label class= "details-label"></label>
   <form method = 'post'>
    <table class = "add">
    <tr>
        <td class = "label-2">Song Name</td><td><input type = "text" name = "song_name" value = "" class = "textbox" required></td>
        </tr>
        <tr>
        <td>Artist Name</td><td><select class = "drop-down" name = "artist_name" ><?php foreach($artists as $artist): if($artist->stage_name == NULL):?> <option value ="<?php echo $artist->stage_name ?>"><?php echo $artist->birth_name ?></option><?php else:?>  <option value = "<?php echo $artist->stage_name ?>"><?php echo $artist->stage_name ?></option><?php endif;endforeach;?></td>
        </tr>
        <tr>
        <td>Album Name</td><td><select class = "drop-down" name = "album_name" ><?php foreach($albums as $album): ?> <option value = "<?php echo $album->album_name ?>"><?php echo $album->album_name ?></option><?php endforeach;?></td>
        </tr>
        <tr><td>Length in Seconds</td><td><input type = "text" name = "length_in_seconds" value = "" class = "textbox" required></td></tr>
        <tr><td>Highest Billboard Ranking</td><td><input type = "text" name = "highest_billboard_ranking" value = "" class = "textbox"></td></tr>
        <tr><td>Billboard Ranking Date</td><td><input type = "text" name = "date_of_billboard_ranking" value = "" class = "textbox"></td></tr>
        <tr><td>Songwriter(s)</td><td><input type = "text" name = "writer_name" value = "" class = "textbox" required></td></tr>
        <tr><td>Comments</td><td><textarea name = "comments"></textarea></td></tr>
        <tr><td class = "button"><button type = "submit">Add Song</button></td><td class = "link" style="text-align:center;"><a href="add_artist.php">Create New Artist</td><td class = "link"><a href="add_album.php">Create New Album</td></tr>
        </form>
</table>
        </div>
</div>


<?php include("view/footer.php");?>