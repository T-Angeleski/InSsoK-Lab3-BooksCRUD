<?php
$book = [
	'id' => '',
	'title' => '',
	'category' => '',
	'price' => 0
];
$isEdit = isset($_GET['id']);
if ($isEdit) {
	$bookId = $_GET['id'];
	require_once "db_connection.php";
	$db = new Database();
	$connection = $db->getConnection();
	$stmt = $connection->prepare("SELECT * FROM books WHERE id = :id");
	$stmt->bindValue(':id', $bookId, SQLITE3_INTEGER);
	$result = $stmt->execute();
	$book = $result->fetchArray(SQLITE3_ASSOC);
	$db->closeConnection();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $isEdit ? 'Edit Book' : 'Create Book'; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
<header class="mb-8">
  <h1 class="text-3xl font-bold text-center text-blue-600">
		<?php echo $isEdit ? 'Edit Book' : 'Create Book'; ?>
  </h1>
</header>

<form method="post" action="book_save.php">
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">

  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
    <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="text" name="title" id="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Category</label>
    <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="text" name="category" id="category" value="<?php echo htmlspecialchars($book['category']); ?>">
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price</label>
    <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="number" step="0.01" name="price" id="price" value="<?php echo htmlspecialchars($book['price']); ?>"
        required>
  </div>
  <div class="flex items-center justify-between">
    <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">
			<?php echo $isEdit ? 'Update Book' : 'Create Book'; ?>
    </button>

    <a href="index.php"
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-5 rounded focus:outline-none
      focus:shadow-outline">Back to books</a>
  </div>
</form>
</body>
</html>