<?php
require("myhelpers.php");
require("helpers.php");
require("scoring.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSCI E-15 | Project 2 - Scrabble Scoring App</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          rel="stylesheet"
          crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row" style="padding-bottom: 5px">
        <div class="col-sm-3">

        </div>
        <div class="col-sm-6">
            <img class="img-responsive title" src="images/scrabble_score.png" alt="Scrabble Score Logo" id="logo">
        </div>
        <div class="col-sm-3">

        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
        </div>

        <?php
        if (isset($_GET["userWord"]) && ($displaySuccess)) { ?>
            <div class="col-sm-6 formText messageArea" style="background-color: mediumseagreen">
                <?php
                for ($i = 0; $i < strlen($wordToCheck); $i++) {
                    ?>
                    <img src="images/<?= $wordToCheck[$i] ?>.png"
                         alt="<?= $wordToCheck[$i] ?> | <?= $letters[$wordToCheck[$i]] ?>" id="responsive-image-small">
                    <?php
                }
                ?>
            </div>
            <?php
        } elseif (isset($_GET["userWord"]) && (!$displaySuccess)) {
            ?>
            <div class="col-sm-6 formText messageArea"
                 style="background-color: crimson;line-height: 75px">
                Sorry, <?= $wordToCheck ?> is not a valid word
            </div>
            <?php
        } else { ?>
            <div class="col-sm-6 formText messageArea"
                 style="background-color:lightgoldenrodyellow; line-height: 75px">Enter a word below to
                score
            </div>
            <?php
        }
        ?>

        <div class="col-sm-3">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 mainArea">
            <form method="GET" action="index.php" name="main">
                <div class="row" style="padding-top: 5px; padding-bottom: 15px">
                    <div class="col-sm-6 formText" style="text-align: right">
                        Word to score:
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="userWord" style="width: 100%">
                    </div>
                </div>
                <div class="row" style="padding-bottom: 15px">
                    <div class="col-sm-6 formText" style="text-align: right">
                        Score Multiplier:
                    </div>
                    <div class="col-sm-6">
                        <select name="multiplier">
                            <option value="none">None</option>
                            <option value="double">Double Word</option>
                            <option value="triple">Triple Word</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 15px">
                    <div class="col-sm-6 formText" style="text-align: right">
                        Bingo! (+50 pts)?
                    </div>
                    <div class="col-sm-6">
                        <input type="checkbox" name="bingo">
                    </div>
                </div>
                <div class="row" style="padding-bottom: 15px">
                    <div class="col-sm-6 formText" style="text-align: right">
                        Check word spelling?
                    </div>
                    <div class="col-sm-6">
                        <input type="checkbox" name="spelling">
                    </div>
                </div>
                <div class="row" style="padding-top:25px; padding-bottom: 15px">
                    <div class="col-sm-12 formText centerContents">
                        <input type="submit" value="Score the Word" class="btn">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-3">
        </div>
    </div>
</div>
</body>
</html>