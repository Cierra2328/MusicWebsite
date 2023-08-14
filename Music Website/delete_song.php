<?php
//this deletes a song 
require 'db.php';
global $connection;
$song_id = $_GET['song_id'];
$album_id = $_GET['album_id'];
$delete_song_query = 'DELETE FROM songs WHERE song_id=:song_id';
$statement = $connection->prepare($delete_song_query);
$statement->execute([':song_id'=> $song_id]);
$statement->closeCursor();
header('Location: view_album.php?album_id=' . $album_id);


?>