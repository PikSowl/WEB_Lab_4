<?php

function redirectToHome(): void
{
    header('Location: /');
    exit();
}

$URL_APP = "https://script.google.com/home/projects/15YigspP7s3wfOCQWI2UkepjJKFOnyPGASDRZAIPqp1dYTSewPOqxHQL8-/exec";

function is_filled(array $details): bool
{
    return !empty($details['title']) && !empty($details['email']) && !empty($details['category']) && !empty($details['description']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $details = [
        'title' => $title,
        'email' => $email,
        'category' => $category,
        'description' => $description,
    ];

    if (!is_filled($details)) {
        exit('Поля формы не заполнены');
    }

    $formBody = http_build_query($details, '', '&');

    $response = json_decode(file_get_contents($URL_APP, false, stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => $formBody,
        ],
    ])), true);
}
redirectToHome();