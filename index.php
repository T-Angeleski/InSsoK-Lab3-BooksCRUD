<?php
require_once "db_connection.php";
$db = new Database();
$connection = $db->getConnection();

$books = $connection->query("SELECT * FROM books");
?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Books</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(270deg, #e0eafc, #cfdef3);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {F
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .table-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background-color: #4a5568;
            color: white;
        }

        .table-row:nth-child(even) {
            background-color: #f7fafc;
        }

        .table-row:hover {
            background-color: #edf2f7;
        }
    </style>
  </head>
  <body class="bg-gray-100 p-8">
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-center text-blue-600">Books Management</h1>
  </header>

  <a href="book_form.php"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-5 rounded focus:outline-none focus:shadow-outline">
    Create Book
  </a>

  <table class="min-w-full bg-white mt-5">
    <thead class="table-header">
    <tr>
      <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">ID</th>
      <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Title</th>
      <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Category</th>
      <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Price</th>
      <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
		<?php while ($book = $books->fetchArray(SQLITE3_ASSOC)): ?>
      <tr class="table-row">
        <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($book['id']); ?></td>
        <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($book['title']); ?></td>
        <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($book['category']); ?></td>
        <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($book['price']); ?></td>
        <td class="py-3 px-6 text-center">
          <a href="book_form.php?id=<?php echo $book['id']; ?>"
             class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4">Update</a>
          <a href="book_delete.php?id=<?php echo $book['id']; ?>"
             class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
             onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
        </td>
      </tr>
		<?php endwhile; ?>
    </tbody>
  </table>
  </body>
  </html>

<?php
$db->closeConnection();
?>