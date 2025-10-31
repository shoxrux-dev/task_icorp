<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $payload = [
        'msg' => 'my message',
        'url' => '<ngrok_url>'
    ];

    $ch = curl_init('https://test.icorp.uz/interview.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    $response = curl_exec($ch);
    curl_close($ch);

    $part1 = json_decode($response, true);

    file_put_contents('part1.txt', $part1);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $json = json_decode($data, true);
    file_put_contents('part2.txt', $json);
}

$code = file_get_contents('part1.txt') . file_get_contents('part2.txt');

$url = 'https://test.icorp.uz/interview.php?code=' . urlencode($code);

$response = file_get_contents($url);

print_r($response);
?>