<?php
require_once 'vendor/autoload.php'; // Ensure Faker is installed via Composer

use Faker\Factory;
use Faker\Provider\en_PH\Person;
use Faker\Provider\en_PH\Address;
use Faker\Provider\Internet;
use Faker\Provider\PhoneNumber;
use Faker\Provider\DateTime;
use Faker\Provider\JobTitle;

$faker = Factory::create('en_PH'); // Set locale for Philippines

// Bootstrap HTML structure
echo "<html><head><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'></head><body class='container mt-4'>";
echo "<h2 class='mb-4'>Generated Fake User Profiles (Philippines)</h2>";
echo "<table class='table table-striped table-bordered'>";
echo "<thead class='table-dark'><tr><th>Full Name</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Birthdate</th><th>Job Title</th></tr></thead><tbody>";

for ($i = 0; $i < 5; $i++) {
    $fullname = $faker->name;
    $email = $faker->unique()->email;
    $phone = '+63 9' . $faker->numberBetween(100000000, 999999999); // PH number format
    $address = $faker->streetAddress . ', ' . $faker->city . ', ' . $faker->state . ', Philippines';
    $birthdate = $faker->date('Y-m-d', '-18 years'); // Ensure age is 18+
    $job = $faker->jobTitle;
    
    echo "<tr>";
    echo "<td>$fullname</td>";
    echo "<td>$email</td>";
    echo "<td>$phone</td>";
    echo "<td>$address</td>";
    echo "<td>$birthdate</td>";
    echo "<td>$job</td>";
    echo "</tr>";
}

echo "</tbody></table></body></html>";
?>
