<?php
// Read the JSON file containing the default scores for letters into an array "$letters"
$lettersJSON = file_get_contents("data/letters.json");
$letters = json_decode($lettersJSON, true);

