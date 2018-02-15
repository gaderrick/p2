<?php
// Set local variables for all the possible _GET variables
$wordToCheck = strtolower((isset($_GET["userWord"]) ? $_GET["userWord"] : ""));
$spelling = (isset($_GET["spelling"]) && $_GET["spelling"] == "on" ? true : false);
$bingo = (isset($_GET["bingo"]) && $_GET["bingo"] == "on" ? true : false);
$multiplier = (isset($_GET["multiplier"]) ? $_GET["multiplier"] : "");

// Read the JSON file containing the default scores for letters into an array "$letters"
$lettersJSON = file_get_contents("data/letters.json");
$letters = json_decode($lettersJSON, true);

// If a spelling check was requested and the word to check is not blank look the word up
if ($spelling && $wordToCheck <> "") {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://od-api.oxforddictionaries.com:443/api/v1/entries/en/" . $wordToCheck);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'app_id: 1e45975c',
        'app_key: b1fca98eda5777bfc5435a4a908be849'
    ));
    $apiResult = trim(curl_exec($ch));
    curl_close($ch);
} else {
    $apiResult = "Not JSON";
}

$isRealWord = isJson($apiResult);

// Read the JSON file containing the default scores for letters into an array "$letters"
$lettersJSON = file_get_contents("data/letters.json");
$letters = json_decode($lettersJSON, true);

// Loop over each letter in $wordToCheck and add up its score based on the values in $letters
$wordScore = 0;

for ($i = 0; $i < strlen($wordToCheck); $i++) {
    $tempLetter = $wordToCheck[$i];
    $wordScore = $wordScore + $letters[$tempLetter];
}

// Apply the multiplier and bingo score modification
if ($wordToCheck <> "") {
    if ($multiplier <> "") {
        switch ($multiplier) {
            case "double":
                $wordScore = $wordScore * 2;
                break;
            case "triple":
                $wordScore = $wordScore * 3;
                break;
        }
    }

    if ($bingo) {
        $wordScore = $wordScore + 50;
    }
}

if (($spelling && $isRealWord) || (!$spelling && $wordScore > 0)) {
    $displaySuccess = true;
} else {
    $displaySuccess = false;
}