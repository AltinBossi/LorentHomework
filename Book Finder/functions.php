<?php
// Path to the JSON file where book data is stored
define('BOOKS_FILE', 'books.json');

// Function to get the list of books
function get_books() {
    if (!file_exists(BOOKS_FILE)) {
        return [];
    }

    $json_data = file_get_contents(BOOKS_FILE);
    return json_decode($json_data, true);
}

// Function to add a book
function add_book($title, $author) {
    $books = get_books();

    $new_book = [
        'id' => uniqid(),
        'title' => $title,
        'author' => $author
    ];

    $books[] = $new_book;
    file_put_contents(BOOKS_FILE, json_encode($books, JSON_PRETTY_PRINT));
}

// Function to delete a book
function delete_book($book_id) {
    $books = get_books();

    // Find the book with the matching ID and remove it
    foreach ($books as $key => $book) {
        if ($book['id'] === $book_id) {
            unset($books[$key]);
            break;
        }
    }

    // Save the updated books back to the JSON file
    file_put_contents(BOOKS_FILE, json_encode(array_values($books), JSON_PRETTY_PRINT));
}
?>