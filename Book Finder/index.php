<?php
// Include the functions file
include('functions.php');

// Get the list of books
$books = get_books();

// Handle book addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_book'])) {
    $book_title = $_POST['book_title'];
    $book_author = $_POST['book_author'];
    add_book($book_title, $book_author);
    header('Location: index.php'); // Redirect after adding a book
}

// Handle book deletion
if (isset($_GET['delete'])) {
    $book_id = $_GET['delete'];
    delete_book($book_id);
    header('Location: index.php'); // Redirect after deleting a book
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Library Management System</h1>
        
        <h2>Books List</h2>
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><a href="?delete=<?php echo $book['id']; ?>" class="delete">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Add New Book</h2>
        <form action="index.php" method="POST">
            <input type="text" name="book_title" placeholder="Book Title" required>
            <input type="text" name="book_author" placeholder="Author Name" required>
            <button type="submit" name="add_book">Add Book</button>
        </form>
    </div>
</body>
</html>