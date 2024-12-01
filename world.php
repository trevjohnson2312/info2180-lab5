<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? $_GET['country'] : '';

$sql = "SELECT * FROM countries WHERE name LIKE '%$country%'";

$stmt = $conn->query($sql);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    echo '<table border="1">';
    echo '<thead><tr>';
    echo '<th>Country Name</th>';
    echo '<th>Continent</th>';
    echo '<th>Independence Year</th>';
    echo '<th>Head of State</th>';
    echo '</tr></thead>';

    echo '<tbody>';
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['continent']) . '</td>';
        echo '<td>' . htmlspecialchars($row['independence_year']) . '</td>';
        echo '<td>' . htmlspecialchars($row['head_of_state']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No countries found matching your search.</p>';
}
?>
