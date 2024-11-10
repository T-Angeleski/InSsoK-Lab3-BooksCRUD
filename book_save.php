<?php
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = $_POST['title'];
	$category = $_POST['category'];
	$price = $_POST['price'];

	$db = new Database();
	$connection = $db->getConnection();

	if (!empty($_POST['id'])) {
		$stmt = $connection->prepare("UPDATE books SET title = :title, category = :category, price = :price WHERE id = :id");
		$stmt->bindValue(':id', $_POST['id'], SQLITE3_INTEGER);
	} else {
		$stmt = $connection->prepare("INSERT INTO books (title, category, price) VALUES (:title, :category, :price)");
	}

	$stmt->bindValue(':title', $title);
	$stmt->bindValue(':category', $category);
	$stmt->bindValue(':price', $price, SQLITE3_FLOAT);

	if ($stmt->execute()) {
		header("Location: index.php");
		exit();
	}

	echo "Error saving book.";
	$db->closeConnection();
}

echo "Incorrect request method, please submit using the form.";
