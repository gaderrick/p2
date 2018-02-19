# Project 2 - Scrabble Score App
+ By: Gerald Derrick
+ Production URL: <http://p2.gaderrick.me>

## Outside resources
+ [Bootstrap Include Files] (https://maxcdn.bootstrapcdn.com/)
+ [Bootstrap 4 Tutorial] (https://www.w3schools.com/bootstrap4/default.asp)
+ [CSS Help (various)] (https://www.w3schools.com/css/)
+ [CSS Centering Button] (https://stackoverflow.com/questions/7560832/how-to-center-a-button-within-a-div)
+ [PHP - Using Curl] (http://www.php.net/manual/en/function.curl-setopt.php)
+ [Check if string is JSON] (https://stackoverflow.com/questions/6041741/fastest-way-to-check-if-a-string-is-json-in-php)
+ [Oxford Dictionary API] (https://od-api.oxforddictionaries.com/api/v1)
+ [W3C Validator] (https://validator.w3.org/)
+ [Spell Check Images] (http://blog.epicbrowser.com/2014/05/spell-check-private-working-in-epic/)
+ [Letter Images] (http://www.echopulse.net/lj/images/scrabble-icons-pack-crystalxp.net-en-1041%20Folder/png/scrabble-uk/)

## Code style divergences

## Notes for instructor
+ Included an option for the user to do a dictionary lookup on a word
+ Added the following function to the MyForm class to check for max string length
```php
protected function maxlength($value, $parameter)
{
    return strlen($value) <= $parameter;
}