<?php

$pattern = "";
$text = "";
$replaceText = "";
$replacedText = "";

$match = "Not checked yet.";

$email_pattern = "#([\w\.-]+)@([\w\.-]+)\.([a-z]{2,5})#";
$phone_pattern = "#\+(998)-(\d{2})-?(\d{3})-?(\d{4})#";

function pattern_checker($pattern)
{
    return function ($text) use ($pattern) {
        if (preg_match($pattern, $text)) {
            return "Pattern matches";
        } else {
            return "Pattern does not match";
        }
    };

}

function remover($pattern){
    return function ($text, $replacement) use($pattern){
        return preg_replace($pattern, $replacement, $text);
    };
}

$check_email = pattern_checker($email_pattern);
$check_phone_number = pattern_checker($phone_pattern);
$remove_whitespaces = remover("# #");
$remove_non_numerics = remover("#[^0-9\.,]*#");
$remove_new_lines = remover("#\n\r#");

function extract_from_brackets($text)
{
    $pattern = "#\[[\w]*\]#";
    preg_match($pattern, $text, $matches);
    return preg_replace("#[\[\]]#", '', $matches[0]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pattern = $_POST["pattern"];
    $text = $_POST["text"];
    $replaceText = $_POST["replaceText"];

    $replacedText = preg_replace($pattern, $replaceText, $text);

    if (preg_match($pattern, $text)) {
        $match = "Match!";
    } else {
        $match = "Does not match!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Valid Form</title>
</head>
<body>
<form action="regex_valid_form.php" method="post">
    <dl>
        <dt>Pattern</dt>
        <dd><input type="text" name="pattern" value="<?= $pattern ?>"></dd>

        <dt>Text</dt>
        <dd><input type="text" name="text" value="<?= $text ?>"></dd>

        <dt>Replace Text</dt>
        <dd><input type="text" name="replaceText" value="<?= $replaceText ?>"></dd>

        <dt>Output Text</dt>
        <dd><?= $match ?></dd>

        <dt>Replaced Text</dt>
        <dd><code><?= $replacedText ?></code></dd>

        <dt>&nbsp;</dt>
        <dd><input type="submit" value="Check"></dd>
    </dl>

</form>
</body>
</html>