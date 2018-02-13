<?php
// Set local variables for all the possible _GET variables
if (isset($_GET["userWord"])) {
    $wordToCheck = $_GET["userWord"];
} else {
    $wordToCheck = "";
}

if (isset($_GET["spelling"])) {
    $checkSpelling = true;
} else {
    $checkSpelling = false;
}

// Read the JSON file containing the default scores for letters into an array "$letters"
$lettersJSON = file_get_contents("data/letters.json");
$letters = json_decode($lettersJSON, true);

// If a spelling check was requested and the word to check is not blank look the word up
if ($checkSpelling && $wordToCheck <> "") {
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
    $apiResult="Not JSON";
}

// If the result was valid JSON, score the word
if (isJson($apiResult)) {
    print $apiResult . "\n\n";
}