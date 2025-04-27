<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Library</title>
</head>
<body>

<h1>Book Library</h1>

<h2>Add a Book</h2>
<form method="post" action="add_book.php">
    Title: <input type="text" name="title" required><br><br>
    Author: <input type="text" name="author"><br><br>
    Category: <input type="text" name="category"><br><br>
    <input type="submit" value="Add Book">
</form>

<hr>

<h2>Search Book</h2>
<form method="get" action="">
    Search: <input type="text" name="search">
    <input type="submit" value="Find">
</form>

<?php
// Search functionality
$where = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $where = "WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR category LIKE '%$search%'";
}

$sql = "SELECT * FROM books $where";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Books:</h2><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>{$row['title']}</strong> by {$row['author']} ({$row['category']}) - Status: {$row['status']}</li>";
    }
    echo "</ul>";
} else {
    echo "No books found.";
}
?>

<hr>

<h2>Borrowing History</h2>

<?php
$history_sql = "SELECT b.title, h.borrower_name, h.borrow_date, h.return_date 
                FROM borrow_history h
                JOIN books b ON h.book_id = b.id
                ORDER BY h.borrow_date DESC";

$history_result = $conn->query($history_sql);

if ($history_result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Book</th>
                <th>Borrower</th>
                <th>Borrowed On</th>
                <th>Returned On</th>
            </tr>";
    while ($row = $history_result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['borrower_name']}</td>
                <td>{$row['borrow_date']}</td>
                <td>{$row['return_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No borrowing history.";
}
?>

</body>
</html>