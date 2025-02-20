<?php
if (isset($_GET['city'])) {
    $city = $_GET['city'];
    $apiKey = "a9a329a686a72abe74a4f4116d0ddac1";  // Your API Key
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
