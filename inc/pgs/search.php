<?php
// Database connection
$host = "localhost"; 
$user = "webshop_user";
$password = "admin";
$database = "webshop";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get search query
$query = $_GET['query'];

// Run search query against all relevant tables
$sql = "
SELECT 'news_blog' as source_table, * FROM blog_news WHERE title LIKE '%$query%' OR content LIKE '%$query%'
UNION ALL
SELECT 'product_categories' as source_table, * FROM categories WHERE name LIKE '%$query%'
UNION ALL
SELECT 'products' as source_table, * FROM products WHERE product_name LIKE '%$query%' OR description LIKE '%$query%'
UNION ALL
SELECT 'contact' as source_table, * FROM contact_query WHERE name LIKE '%$query%' OR subject LIKE '%$query%'
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output search results
    while($row = $result->fetch_assoc()) {
        // Process each result depending on the table
        switch($row['source_table']) {
            case 'news_blog':
                $link = "newsBlog.php?id=" . $row['id'];
                break;
            case 'product_categories':
                $link = "prod_categories.php?id=" . $row['id'];
                break;
            case 'products':
                $link = "prod_details.php?id=" . $row['id'];
                break;
            case 'contact':
                $link = "contact.php?id=" . $row['id'];
                break;
            default:
                $link = "#";
        }

        // Display result as a link
        echo "<a href='" . $link . "'>" . $row["title"] . "</a><br>";
    }
} else {
    echo "No results found";
}
$conn->close();
?>
