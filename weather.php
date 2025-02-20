<?php
require 'vendor/autoload.php'; // Load Composer dependencies

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (isset($_GET['city'])) {
    $city = $_GET['city'];
    $apiKey = $_ENV['API_KEY']; // Fetch API key from .env

    $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    $response = file_get_contents($url);
    $weatherData = json_decode($response, true);

    if ($weatherData['cod'] == 200) {
        $result = [
            'temp' => $weatherData['main']['temp'],
            'weather' => $weatherData['weather'][0]['description']
        ];
    } else {
        $result = ['error' => 'City not found'];
    }

    header('Content-Type: application/json');
    echo json_encode($result);
}
?>
