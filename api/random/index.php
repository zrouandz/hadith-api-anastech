<?php

header('Content-Type: application/json');

// Daftar file hadits
$books = ['bukhari', 'muslim', 'abu-dawud'];

// Pilih kitab random
$book = $books[array_rand($books)];

// Load data hadits dari folder data
$file = __DIR__ . "/../../../data/{$book}.json";

if (!file_exists($file)) {
    echo json_encode(["status" => false, "message" => "File tidak ditemukan"]);
    exit;
}

$data = json_decode(file_get_contents($file), true);

if(!$data || !isset($data['data'])) {
    echo json_encode(["status" => false, "message" => "Data kosong atau rusak"]);
    exit;
}

// Pilih hadits random
$hadiths = $data['data'];
$random = $hadiths[array_rand($hadiths)];

echo json_encode([
    "status" => true,
    "book" => $book,
    "number" => $random['number'],
    "arab" => $random['arab'],
    "id" => $random['id']
]);
