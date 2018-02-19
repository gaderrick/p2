<?php
require('myhelpers.php');
require('helpers.php');
require('Form.php');
require('MyForm.php');
require('scoring.php');
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>CSCI E-15 | Project 2 - Scrabble Scoring App</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
          rel='stylesheet'
          crossorigin='anonymous'>
    <link href='styles.css' rel='stylesheet'>
</head>
<body>
<div class='container-fluid'>
    <div class='row' style='padding-bottom: 5px'>
        <div class='col-sm-12'>
            <img class='img-responsive title' src='images/scrabble_score.png' alt='Scrabble Score Logo' id='logo'>
        </div>
    </div>
    <div class='row'>
        <?php if ($form->isSubmitted()): ?>
            <?php if (($wordScore > 0 && $isRealWord && $spelling) || ($wordScore > 0 && !$spelling)): ?>
                <div class='col-sm-12 formText messageArea alert alert-success'>
                    Your Word:<br>
                    <?php for ($i = 0; $i < strlen($wordToCheck); $i++): ?>
                        <img src='images/<?= $wordToCheck[$i] ?>.png'
                             alt='<?= $wordToCheck[$i] ?> | <?= $letters[$wordToCheck[$i]] ?>'
                             class='responsive-image-small'>
                    <?php endfor ?>
                    <br>
                    Scored <?= $wordScore ?> points<?= ($showScoreOptions > 0 ? ' with the following options:' : '') ?>
                    <br><br>
                    <?php if ($multiplier == 'double'): ?>
                        <img class='img-responsive' src='images/double.png' alt='2x Word Score' style='max-width: 75px'
                             id='double'>
                    <?php elseif ($multiplier == 'triple'): ?>
                        <img class='img-responsive' src='images/triple.png' alt='3x Word Score' style='max-width: 75px'
                             id='triple'>
                    <?php endif ?>
                    <?php if ($bingo): ?>
                        <img class='img-responsive' src='images/bingo.png'
                             alt='Bingo! (Image adapted from http://www.onlinewebfonts.com/icon starter image)'
                             style='max-width: 75px'
                             id='bingo'>
                    <?php endif ?>
                    <?php if ($spelling && $isRealWord): ?>
                        <img class='img-responsive' src='images/spell.png' alt='Spell Check (its a real word)'
                             style='max-width: 75px' id='spell'>
                    <?php endif ?>
                </div>
            <?php elseif (($form->hasErrors)): ?>
                <div class='col-sm-12 formText messageArea alert alert-danger' style='line-height: 50px'>
                    <?php if ($form->hasErrors) : ?>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            <?php else: ?>
                <div class='col-sm-12 formText messageArea alert alert-danger' style='line-height: 50px'>
                    Sorry, <?= sanitize(($wordToCheck <> '' ? $wordToCheck : 'a blank')) ?> is not a valid word<br>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class='col-sm-12 formText messageArea alert alert-info'
                 style='line-height: 75px'>Enter a word below to score
            </div>
        <?php endif; ?>
    </div>
    <div class='row'>
        <div class='col-sm-12 mainArea'>
            <form method='GET' action='index.php' name='main'>
                <div class='row' style='padding-top: 5px; padding-bottom: 15px'>
                    <div class='col-sm-6 formText' style='text-align: right'>
                        <label for='userWord'>Word to score:</label>
                    </div>
                    <div class='col-sm-6'>
                        <input type='text' name='userWord' style='width: 150px' id='userWord'
                               placeholder='(max of 7 letters)'
                               value='<?= sanitize($form->prefill("userWord")) ?>'>
                    </div>
                </div>
                <div class='row' style='padding-bottom: 15px'>
                    <div class='col-sm-6 formText' style='text-align: right'>
                        <label for='multiplier'>Score Multiplier:</label>
                    </div>
                    <div class='col-sm-6'>
                        <select name='multiplier' id='multiplier'>
                            <option value='none' <?= ($form->prefill("multiplier") == 'none' ? 'selected' : '') ?>>
                                None
                            </option>
                            <option value='double' <?= ($form->prefill("multiplier") == 'double' ? 'selected' : '') ?>>
                                Double Word
                            </option>
                            <option value='triple' <?= ($form->prefill("multiplier") == 'triple' ? 'selected' : '') ?>>
                                Triple Word
                            </option>
                        </select>
                    </div>
                </div>
                <div class='row' style='padding-bottom: 15px'>
                    <div class='col-sm-6 formText' style='text-align: right'>
                        <label for='bingo'>Bingo! (+50 pts)?</label>
                    </div>
                    <div class='col-sm-6'>
                        <input type='checkbox' name='bingo'
                               id='bingo' <?= ($form->prefill("bingo") == 'on' ? 'checked' : '') ?>>
                    </div>
                </div>
                <div class='row' style='padding-bottom: 15px'>
                    <div class='col-sm-6 formText' style='text-align: right'>
                        <label for='spelling'>Check word spelling?</label>
                    </div>
                    <div class='col-sm-6'>
                        <input type='checkbox' name='spelling'
                               id='spelling' <?= ($form->prefill("spelling") == 'on' ? 'checked' : '') ?>>
                    </div>
                </div>
                <div class='row' style='padding-top:25px; padding-bottom: 15px'>
                    <div class='col-sm-12 formText centerContents'>
                        <input type='submit' value='Score the Word' class='btn'>&nbsp;&nbsp;
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>