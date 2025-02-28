<?php
require_once 'vendor/autoload.php'; // Ensure Faker is installed via Composer

use Faker\Factory;

$faker = Factory::create();

// Predefined genres
$genres = ['Fiction', 'Non-Fiction', 'Science Fiction', 'Fantasy', 'Mystery', 'Thriller', 'Romance', 'Historical', 'Biography', 'Self-Help'];

// Bootstrap HTML structure
echo "<html><head><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'></head><body class='container mt-4'>";
echo "<h2 class='mb-4'>Generated Fake Books Table</h2>";
echo "<table class='table table-striped table-bordered'>";
echo "<thead class='table-dark'><tr><th>Title</th><th>Author</th><th>Genre</th><th>Publication Year</th><th>ISBN</th><th>Summary</th></tr></thead><tbody>";

for ($i = 0; $i < 15; $i++) {
    $title = $faker->words(3, true);
    $author = $faker->name;
    $genre = $faker->randomElement($genres);
    $year = $faker->numberBetween(1900, 2024);
    $isbn = $faker->isbn13;
    $summary = $faker->sentence(10);
    
    echo "<tr>";
    echo "<td>$title</td>";
    echo "<td>$author</td>";
    echo "<td>$genre</td>";
    echo "<td>$year</td>";
    echo "<td>$isbn</td>";
    echo "<td>$summary</td>";
    echo "</tr>";
}

echo "</tbody></table></body></html>";
?>
