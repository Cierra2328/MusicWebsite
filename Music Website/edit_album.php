<?php
//this file allows the user to edit an album
include("view/header.php");
require 'db.php';
if (
    isset($_POST['album_name'])  && isset($_POST['artist_id']) &&
    isset($_POST['notable_fact'])  && isset($_POST['genre_id'])  &&
    isset($_POST['release_date']) && isset($_POST['record_label'])
) {
    //assigning variables to get and post 
    $album_id = $_GET['album_id'];
    $album_name = $_POST['album_name'];
    $artist_id = $_POST['artist_id'];
    $notable_fact = !empty($_POST['notable_fact']) ? $_POST['notable_fact'] : NULL;
    $genre_id = $_POST['genre_id'];
    $release_date = $_POST['release_date'];
    $record_label = $_POST['record_label'];

    $add_album_query = 'UPDATE albums SET album_name = :album_name, artist_id = :artist_id, record_label = :record_label, genre_id = :genre_id, release_date = :release_date, notable_fact = :notable_fact
                        WHERE album_id = :album_id';
    $statement = $connection->prepare($add_album_query);
    $statement->execute([':album_name' => $album_name, ':artist_id' => $artist_id, ':record_label' => $record_label, ':genre_id' => $genre_id, ':release_date' => $release_date, ':notable_fact' => $notable_fact, ':album_id' => $album_id]);
    $add_album = $statement->fetch(PDO::FETCH_OBJ); 
    header('Location: all_albums.php');
}
function get_all_artists() //get artist info 
{
    global $connection;
    $artist_query = 'SELECT stage_name, artist_id, birth_name
                    FROM artists';
    $statement = $connection->prepare($artist_query);
    $statement->execute();
    $artists = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $artists;
}
function album_info(){ //get album info
    global $connection;
    $album_id = $_GET['album_id'];
    $album_info_query = 'SELECT * FROM albums WHERE album_id = :album_id';
    $statement = $connection->prepare($album_info_query);
    $statement->execute([':album_id'=>$album_id]);
    $album = $statement->fetch(PDO::FETCH_OBJ);
    return $album;
}
$album_id = $_GET['album_id'];
global $connection; 
//gets genre info
$genre_query = 'SELECT * FROM genres';
$statement = $connection->prepare($genre_query);
$statement->execute();
$genres = $statement->fetchAll(PDO::FETCH_OBJ);
$statement->closeCursor();
$artists = get_all_artists();
$album = album_info();
?>

<div class="body-add">
    <div class = "body">
    <h1><a href="view_album.php?album_id=<?= $album->album_id; ?>"  title="Back to Album Details"><svg class = "icons-back" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
</svg></a>Edit Album <div class= "space-header"></div></h1>
    <label class= "details-label"></label>
   <form method="post">
    <table class = "add">
    <tr>
        <td class = "label-2">Album Name</td><td><input type = "text" name = "album_name" value = "<?=$album->album_name;?>"class = "textbox" required></td>
        </tr>
        <tr>
            <!-- these loops identify if the id matches was given via get method and displays the current artist, genre and album, 
            in fact everything that is displayed is the current settings -->
        <td>Artist Name</td><td><select class = "drop-down" name = "artist_id" ><?php foreach($artists as $artist) if($artist->artist_id == $album->artist_id){?> <option value = "<?php echo $artist->artist_id ?>" selected><?php if($artist->stage_name == NULL) {echo $artist->birth_name;}else{ echo $artist->stage_name;} ?></option><?php } else{ ?>
        <option value = "<?php echo $artist->artist_id ?>"><?php if($artist->stage_name == NULL) {echo $artist->birth_name;}else{ echo $artist->stage_name;} };?></td></tr>
        <tr>
        <td>Record Label</td><td><input type = "text" name = "record_label" value="<?=$album->record_label;?>"class = "textbox" required></td>
        </tr>
        <tr><td>Genre</td><td><select class = "drop-down" name = "genre_id" ><?php foreach($genres as $genre): if($genre->genre_id == $album->genre_id){?> <option value = "<?php echo $genre->genre_id ?>" selected><?php echo $genre->genre; ?></option><?php } else{ ?>
        <option value = "<?php echo $genre->genre_id ?>"><?php echo $genre->genre ?><?php } endforeach;?></td></tr>
        <tr><td>Release Date</td><td><input type = "date" name = "release_date" value = "<?=$album->release_date;?>" class = "textbox" required></td></tr>
        <tr><td>Notable Fact</td><td><textarea name = "notable_fact"><?php echo $album->notable_fact;?></textarea></td></tr>
        <tr><td class = "button"><button type = "submit">Update Album</button></td><td class = "link" style="text-align:center;"><a href="add_artist.php">Create New Artist</td></tr>
</form>
</table>
</div>
</div>


<?php include("view/footer.php");?>