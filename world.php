<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? $_GET['country'] : '';
$cities = isset($_GET['cities']) ? $_GET['cities'] : '';

if ($cities) {
    $sql = "SELECT city.name AS city_name, city.district, city.population, country.head_of_state 
    FROM cities city
    JOIN countries country ON city.country_code = country.code
    WHERE country.name LIKE :country";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':country' => '%' . $country . '%']);
    $citiesResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($citiesResults) {
      echo '<h2>Cities in ' . htmlspecialchars($country) . ':</h2>';
      echo '<table border="1">';
      echo '<thead><tr>';
      echo '<th>Name</th>';
      echo '<th>District</th>';
      echo '<th>Population</th>';
      echo '</tr></thead>';
      echo '<tbody>';
      
      foreach ($citiesResults as $row) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($row['city_name']) . '</td>';
          echo '<td>' . htmlspecialchars($row['district']) . '</td>';
          echo '<td>' . htmlspecialchars($row['population']) . '</td>';
          echo '</tr>';
      }
      
      echo '</tbody>';
      echo '</table>';
    } else {
        echo '<p>No cities found for ' . htmlspecialchars($country) . '.</p>';
    }
} else {
    $sql = "SELECT * FROM countries WHERE name LIKE :country";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':country' => '%' . $country . '%']);
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
}
?>
