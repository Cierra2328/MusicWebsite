<?php
include("view/header.php");
require 'db.php';

//this file adds an album to the database 
//this checks for the form being filled out and info posted
if (
    isset($_POST['album_name'])  && isset($_POST['artist_id']) &&
    isset($_POST['notable_fact'])  && isset($_POST['genre_id'])  &&
    isset($_POST['release_date']) && isset($_POST['record_label'])
) {
    //gathering the post info and assigning it variables
    $album_name = $_POST['album_name'];
    $artist_id = $_POST['artist_id'];
    $notable_fact = !empty($_POST['notable_fact']) ? $_POST['notable_fact'] : NULL;
    $genre_id = $_POST['genre_id'];
    $release_date = $_POST['release_date'];
    $record_label = $_POST['record_label'];

    //query for adding the album
    $add_album_query = 'INSERT INTO albums (album_name, artist_id, record_label, genre_id, release_date, notable_fact) 
    VALUES (:album_name, :artist_id, :record_label, :genre_id, :release_date, :notable_fact)';
    $statement = $connection->prepare($add_album_query);
    //inserting the info into the query and executing it
    $statement->execute([':album_name' => $album_name, ':artist_id' => $artist_id, ':record_label' => $record_label, ':genre_id' => $genre_id, ':release_date' => $release_date, ':notable_fact' => $notable_fact]);
    $add_album = $statement->fetch(PDO::FETCH_OBJ); 
    header('Location: all_albums.php'); //after album is added, all albums page is displayed
}
function get_all_artists() //gets artist info
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
global $connection;
$genre_query = 'SELECT * FROM genres';
$statement = $connection->prepare($genre_query);
$statement->execute();
$genres = $statement->fetchAll(PDO::FETCH_OBJ);
$statement->closeCursor();
$artists = get_all_artists();
?>

<div class="body-add">
    <div class = "body">
        <!--h1 has button that takes user back to the all albums page -->
    <h1><a href="all_albums.php"  title="Back to All Albums"><svg class = "icons-back" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
</svg></a>Add Album <div class= "space-header"></div></h1>
    <label class= "details-label"></label>
   <form method="post">
    <table class = "add">
    <tr>
        <td class = "label-2">Album Name</td><td><input type = "text" name = "album_name" class = "textbox" required></td>
        </tr>
        <tr>
            <!-- this foreach loop checks to see if the artist has a stage name and if not then it displays the birth name instead of stage name -->
        <td>Artist Name</td><td><select class = "drop-down" name = "artist_id" ><?php foreach($artists as $artist): if($artist->stage_name == NULL): ?> <option value ="<?php echo $artist->artist_id ?>"><?php echo $artist->birth_name ?></option><?php else:?><option value = "<?php echo $artist->artist_id ?>"><?php echo $artist->stage_name ?></option><?php endif;endforeach;?></td>
        </tr>
        <tr>
        <td>Record Label</td><td><input type = "text" name = "record_label" class = "textbox" required></td>
        </tr>
        <!-- this foreach loops displays all the genres -->
        <tr><td>Genre</td><td><select class = "drop-down" name = "genre_id" ><?php foreach($genres as $genre): ?> <option value = "<?php echo $genre->genre_id ?>"><?php echo $genre->genre ?></option><?php endforeach;?></td></tr>
        <tr><td>Release Date</td><td><input type = "date" name = "release_date" value = "" class = "textbox" required></td></tr>
        <tr><td>Notable Fact</td><td><textarea name = "notable_fact"></textarea></td></tr>
        <tr><td class = "button"><button type = "submit">Add Album</button></td><td class = "link" style="text-align:center;"><a href="add_artist.php">Create New Artist</td></tr>
</form>
</table>
</div>
</div>


<?php include("view/footer.php");?>