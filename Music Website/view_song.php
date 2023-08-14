<?php
//this file displays the song details
include("view/header.php");
require 'db.php';

function get_songs(){ //get song info
    global $connection;
    $song_id = $_GET['song_id'];
    $song_query = 'SELECT *
                        FROM songs 
                            JOIN albums ON songs.album_id = albums.album_id 
                            JOIN artists ON albums.artist_id = artists.artist_id
                            WHERE songs.song_id= :song_id
                            ORDER BY song_name';
    $statement = $connection->prepare($song_query);
    $statement->bindParam(':song_id', $song_id, PDO::PARAM_INT);
    $statement->execute([':song_id'=> $song_id]);
    $song_info = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $song_info;
}
$song_info = get_songs();
$song_id = $_GET['song_id'];
?>

<div class="body-details">
  <!-- h1 has icons on both sides to edit and delete the song -->
<h1><a href = "edit_song.php?song_id= <?=$song_id?>" title= "Edit Song"><svg class = "icons-editing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg></a>Song Details <a onclick="return confirm('Are you sure you want to delete <?php echo $song_info[0]->song_name; ?>?')" href="delete_song.php?song_id=<?= $song_id ?>&album_id=<?=$song_info[0]->album_id?>" title = "Delete Song"><svg class = "icons-editing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg></a></h1>
    <label class= "details-label"></label>
    <?php if (isset($song_info)) : ?>
    <table>
        <tr>
        <?php foreach($song_info as $songs):?> <!-- display song info -->
        <td><label class = "title">Song Name:</label></td><td class = "details"> <?= $songs->song_name; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Album Name:</label></td><td class = "link"><a class="link" href="view_album.php?album_id=<?= $songs->album_id; ?>"> <?= $songs->album_name; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Artist Name: </label></td><td class = "link"><a class="link" href="view_artist.php?artist_id=<?= $songs->artist_id; ?>"><?= $songs->stage_name; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Length in Seconds: </label></td><td class = "details"><?= $songs->length_in_seconds ?></td>
        </tr>
        <tr>
        <td><label class = "title">Highest Billboard Ranking: </label></td><td class = "details"><?= $songs->highest_billboard_ranking ?></td>
        </tr>
        <tr>
        <td><label class = "title">Date of Billboard Ranking:</label></td><td class = "details"> <?= $songs->date_of_billboard_ranking; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Songwriter(s): </label></td><td class = "details"><?= $songs->writer_name ?></td>
        </tr>
</table>
<?php endforeach;?>
<?php else:?>
    <table>
        <tr>
            <th>No details available</th>
</table>
<?php endif; ?>

</div>


<?php include("view/footer.php");?>