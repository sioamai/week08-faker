<?php
require_once 'vendor/autoload.php'; // Ensure Faker is installed via Composer

use Faker\Factory;
use PDO;

$faker = Factory::create('en_PH'); // Set locale for Philippines

// Database connection
$dsn = 'mysql:host=localhost;dbname=your_database;charset=utf8mb4';
$username = 'your_username';
$password = 'your_password';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$pdo = new PDO($dsn, $username, $password, $options);

// Insert Offices
for ($i = 0; $i < 50; $i++) {
    $stmt = $pdo->prepare("INSERT INTO Office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $faker->company,
        $faker->phoneNumber,
        $faker->companyEmail,
        $faker->streetAddress,
        $faker->city,
        'Philippines',
        $faker->postcode
    ]);
}

// Insert Employees
$office_ids = $pdo->query("SELECT id FROM Office")->fetchAll(PDO::FETCH_COLUMN);
for ($i = 0; $i < 200; $i++) {
    $stmt = $pdo->prepare("INSERT INTO Employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $faker->lastName,
        $faker->firstName,
        $faker->randomElement($office_ids),
        $faker->address
    ]);
}

// Insert Transactions
$employee_ids = $pdo->query("SELECT id FROM Employee")->fetchAll(PDO::FETCH_COLUMN);
for ($i = 0; $i < 500; $i++) {
    $stmt = $pdo->prepare("INSERT INTO Transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $faker->randomElement($employee_ids),
        $faker->randomElement($office_ids),
        $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d H:i:s'),
        $faker->randomElement(['Created', 'Updated', 'Deleted', 'Reviewed']),
        $faker->sentence,
        strtoupper($faker->bothify('DOC-###-????'))
    ]);
}

echo "Fake data successfully inserted!";
?>
