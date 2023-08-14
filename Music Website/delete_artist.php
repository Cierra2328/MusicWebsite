<?php
//this deletes the artist and every album and song associated with the artist
//to maintain referential integrity
require 'db.php';
global $connection;
$artist_id = $_GET['artist_id'];
$delete_songs = 'DELETE FROM songs WHERE artist_id = :artist_id;';
$delete_albums = 'DELETE FROM albums WHERE artist_id = :artist_id';
$delete_artist = 'DELETE FROM artists WHERE artist_id = :artist_id';
$statement = $connection->prepare($delete_songs);
$statement->execute([':artist_id'=> $artist_id]);
$statement = $connection->prepare($delete_albums);
$statement->execute([':artist_id'=> $artist_id]);
$statement = $connection->prepare($delete_artist);
$statement->execute([':artist_id'=> $artist_id]);
$statement->closeCursor();
header('Location: all_artists.php');


?>