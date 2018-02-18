<?php

// Load additional Form class functionality
$form = new Derrick\MyForm($_GET);

// Set local variables from the submitted forms _GET values and initialize variables
$wordToCheck = strtolower($form->get('userWord', ''));
$spelling = $form->get('spelling', 'off');
$spelling = ($spelling == 'on' ? true : false);
$bingo = $form->get('bingo', 'off');
$bingo = ($bingo == 'on' ? true : false);
$multiplier = $form->get('multiplier', '');

$wordScore = 0;

// Read the JSON file containing the default scores for letters into an array '$letters'
$lettersJSON = file_get_contents('data/letters.json');
$letters = json_decode($lettersJSON, true);

// Process the apps logic if the form was submitted
if ($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'userWord' => 'required|alpha|maxlength:7',
        ]
    );

    if (!$form->hasErrors) {
        // If a spelling check was requested and the word to check is not blank look the word up
        if ($spelling) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://od-api.oxforddictionaries.com:443/api/v1/entries/en/' . $wordToCheck);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'app_id: 1e45975c',
                'app_key: b1fca98eda5777bfc5435a4a908be849'
            ));
            $apiResult = trim(curl_exec($ch));
            curl_close($ch);
        } else {
            $apiResult = 'Not JSON';
        }

        // Only a properly formed JSON response will get a true value with the isJson function
        $isRealWord = isJson($apiResult);

        // Loop over each letter in $wordToCheck and add up its score based on the values in $letters
        for ($i = 0; $i < strlen($wordToCheck); $i++) {
            $tempLetter = $wordToCheck[$i];
            $wordScore = $wordScore + $letters[$tempLetter];
        }

        // Apply the double and triple multipliers if selected
        if ($wordToCheck <> '') {
            if ($multiplier <> '') {
                switch ($multiplier) {
                    case 'double':
                        $wordScore = $wordScore * 2;
                        break;
                    case 'triple':
                        $wordScore = $wordScore * 3;
                        break;
                }
            }

            // Apply the bingo score modification if selected
            if ($bingo) {
                $wordScore = $wordScore + 50;
            }
        }
    }
}