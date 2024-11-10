<?php
require_once "db_connection.php";

if (isset($_GET['id'])) {
	$bookId = $_GET['id'];

	$db = new Database();
	$connection = $db->getConnection();

	$stmt = $connection->prepare("DELETE FROM books WHERE id = :id");
	$stmt->bindValue(':id', $bookId, SQLITE3_INTEGER);

	if ($stmt->execute()) {
		header("Location: index.php");
		exit();
	}
	echo "Error deleting book.";
}