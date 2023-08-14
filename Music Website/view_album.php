<?php
//displays details and songs from an album
include("view/header.php");
require 'db.php';
function get_album(){ //get album info
global $connection;
$album_id = $_GET['album_id'];
$album_query = 'SELECT album_name, stage_name, record_label, genre, release_date, notable_fact, artists.artist_id, birth_name
                FROM albums 
                JOIN artists ON albums.artist_id = artists.artist_id 
                JOIN genres on albums.genre_id = genres.genre_id
                WHERE albums.album_id = :album_id';
$statement = $connection->prepare($album_query);
$statement->bindParam(':album_id', $album_id, PDO::PARAM_INT);
$statement->execute([':album_id'=> $album_id]);
$album_info = $statement->fetchAll(PDO::FETCH_OBJ);
$statement->closeCursor();
return $album_info;
}
$album_info = get_album();
function get_songs(){ //get song info
    global $connection;
    $album_id = $_GET['album_id'];
    $song_query = 'SELECT song_name, writer_name, highest_billboard_ranking, length_in_seconds, song_id
                    FROM songs 
                    JOIN albums ON albums.album_id = songs.album_id 
                    WHERE songs.album_id = :album_id';
     if(isset($_GET['sort']) && isset($_GET['by'])){
        $sort = $_GET['sort'];
        $by = $_GET['by'];
        $song_query .= " ORDER BY $by $sort";
    }
    else{
        $song_query .= ' ORDER BY song_name';
    }
    $statement = $connection->prepare($song_query);
    $statement->bindParam(':album_id', $album_id, PDO::PARAM_INT);
    $statement->execute([':album_id'=> $album_id]);
    $songs = $statement->fetchAll(PDO::FETCH_OBJ);
    $statement->closeCursor();
    return $songs;
}
$songs = get_songs();
$album_id = $_GET['album_id'];
?>

<div class="body">
  <!-- h1 has button on both sides to edit and delete the album -->
<h1><a href = "edit_album.php?album_id= <?=$album_id?>" title= "Edit Album"><svg class = "icons-editing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg></a>Album Details <a onclick="return confirm('Are you sure you want to delete <?php echo $album_info[0]->album_name; ?>? This will delete all songs associated with this album.')" href="delete_album.php?album_id= <?= $album_id ?>" title = "Delete Album"><svg class = "icons-editing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg></a></h1>
    <label class= "details-label"></label>
    <?php if (isset($album_info)) : ?>
    <table class = "details">
        <tr> <!-- display album info in a table -->
        <?php foreach($album_info as $album):?>
        <td><label class = "title">Album Name:</label></td><td class = "details"> <?= $album->album_name; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Artist:</label></td><td class = "link"><a class="link" href="view_artist.php?artist_id=<?= $album->artist_id; ?>"> <?php if($album->stage_name == NULL){ echo $album->birth_name; } else echo $album->stage_name; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Record Label: </label></td><td class = "details"><?= $album->record_label; ?></td>
        </tr>
        <tr>
        <td><label class = "title">Genre: </label></td><td class = "details"><?= $album->genre ?></td>
        </tr>
        <tr>
        <td><label class = "title">Notable Fact:</label></td><td class = "details"> <?= $album->notable_fact; ?></td>
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
<div class="body">
<h1 class="table_header">Songs from  <?= $album->album_name; ?></h1>
    <table class = "details">
    <thead>
            <tr><!-- all headers have icons to sort the songs -->
            <th><a class = "icons" href="view_album.php?sort=asc&by=song_name&album_id=<?=$album_id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
  <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg> </a>Song<a class = "icons" href="view_album.php?sort=desc&by=song_name&album_id=<?=$album_id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-up" viewBox="0 0 16 16">
  <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707V12.5zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg></a></th>
<th><a class = "icons" href="view_album.php?sort=asc&by=writer_name&album_id=<?=$album_id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
  <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg> </a>Songwriter<a class = "icons" href="view_album.php?sort=desc&by=writer_name&album_id=<?=$album_id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-up" viewBox="0 0 16 16">
  <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707V12.5zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg></a></th>
<th><a class = "icons" href="view_album.php?sort=asc&by=highest_billboard_ranking&album_id=<?=$album_id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
  <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg> </a>Billboard Ranking<a class = "icons" href="view_album.php?sort=desc&by=highest_billboard_ranking&album_id=<?=$album_id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-up" viewBox="0 0 16 16">
  <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707V12.5zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg></a></th>
<th><a class = "icons" href="view_album.php?sort=asc&by=length_in_seconds&album_id=<?=$album_id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
  <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg> </a>Length in Seconds<a class = "icons" href="view_album.php?sort=desc&by=length_in_seconds&album_id=<?=$album_id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-up" viewBox="0 0 16 16">
  <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707V12.5zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
</svg></a></th>
            </tr>
        </thead>
        <?php foreach ($songs as $song) : ?> <!--display song info -->

            <tr class = "rows">
                <td class="link"><a href="view_song.php?song_id=<?= $song->song_id; ?>"><?= $song->song_name; ?></td>
                <td><?= $song->writer_name; ?></td>
                <td><?= $song->highest_billboard_ranking; ?></td>
                <td><?= $song->length_in_seconds; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
        </div>

<?php include("view/footer.php");?>