<?php
//this file displays the artist details
include("view/header.php");
require 'db.php';
function get_artist(){ //get artist info
global $connection;
$artist_id = $_GET['artist_id'];
$artist_query = 'SELECT *
                FROM artists
                WHERE artist_id = :artist_id';
$statement = $connection->prepare($artist_query);
$statement->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
$statement->execute([':artist_id'=> $artist_id]);
$artist_info = $statement->fetchAll(PDO::FETCH_OBJ);
$statement->closeCursor();
return $artist_info;
}
$artist_info = get_artist();
function get_songs(){ //get songs by artist 
    global $connection;
    $artist_id = $_GET['artist_id'];
    $song_query = 'SELECT song_name, song_id
                    FROM songs 
                    JOIN artists ON artists.artist_id = songs.artist_id 
                    WHERE songs.artist_id = :artist_id
                    ORDER BY song_name';
    $statement = $connection->prepare($song_query);
    $statement->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $statement->execute([':artist_id'=> $artist_id]);
    $songs = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $songs;
}
$songs = get_songs();
$artist_id = $_GET['artist_id'];
?>

<div class="body-details">
    <!-- h1 has button on both sides to edit and delete the artist -->
<h1><a href = "edit_artist.php?artist_id= <?=$artist_id?>" title= "Edit Artist"><svg class = "icons-editing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg></a>Artist Details <a onclick="return confirm('Are you sure you want to delete <?php echo $artist_info[0]->stage_name; ?>? This will delete all songs and albums associated with this artist.')" href="delete_artist.php?artist_id= <?= $artist_id ?>" title = "Delete Artist"><svg class = "icons-editing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg></a></h1>
    <label class= "details-label"></label>
    <?php if (isset($artist_info)) : ?>
    <table>
        <tr>
        <?php foreach($artist_info as $artist):?> <!--display artist info -->
        <td><label class = "title">Artist Name:</label></td><td class = "details"> <?= $artist->birth_name; ?></td>
        </tr>
        <tr>
        <td><label class = "title"> Stage Name:</label></td><td class = "details"> <?= $artist->stage_name; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Date of Birth: </label></td><td class = "details"><?= $artist->date_of_birth; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Hometown: </label></td><td class = "details"><?= $artist->hometown ?></td>
        </tr>
        <tr>
        <td><label class = "title">Date of Death: </label></td><td class = "details"><?= $artist->date_of_death ?></td>
        </tr>
        <tr>
        <td><label class = "title">Notable Fact:</label></td><td class = "details"> <?= $artist->fun_fact; ?></td>
</table>
<?php endforeach;?>
<?php else:?>
    <table>
        <tr>
            <th>No details available</th>
</table>
<?php endif; ?>

</div>
<div class = "space">
    <p style = "color: transparent;"> bro</p>
</div>
<div class="body-details">
<h1 class="table_header">Songs from  <?php if($artist->stage_name == NULL){ echo $artist->birth_name; } else echo $artist->stage_name; ?></h1>
    <table >
        <?php foreach ($songs as $song) : ?> <!-- display artist's songs-->

            <tr class = "rows">
                <td class="link"><a href="view_song.php?song_id=<?= $song->song_id; ?>"><?= $song->song_name; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
        </div>

<?php include("view/footer.php");?>