<?php
//this deletes an album and all songs associated with that album
require 'db.php';
global $connection;
$album_id = $_GET['album_id'];
$delete_song_query = 'DELETE FROM songs WHERE album_id=:album_id';
$delete_album = 'DELETE FROM albums WHERE album_id=:album_id';
$statement = $connection->prepare($delete_song_query);
$statement->execute([':album_id'=> $album_id]);
$statement = $connection->prepare($delete_album);
$statement->execute([':album_id'=> $album_id]);
$statement->closeCursor();
header('Location: all_albums.php');


?>