<?php
function encryptText($text, $method) {
    switch ($method) {
        case "69":
            $binary_representation = join('', array_map(function ($char) {
                return str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
            }, str_split($text)));
            return join(':', str_split(str_replace(['0', '1'], ['6', '9'], $binary_representation), 8));

        case "Scramble":
            return str_shuffle($text);

        case "Stingy":
            $shift = 3;
            $result = '';
            foreach (str_split($text) as $char) {
                if (ctype_alpha($char)) {
                    $ascii = ord(ctype_upper($char) ? 'A' : 'a');
                    $result .= chr($ascii + (ord($char) - $ascii + $shift) % 26);
                } else {
                    $result .= $char;
                }
            }
            return $result;

        default:
            return $text;
    }
}

$outputText = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputText = $_POST["inputText"];
    $selectedMethod = $_POST["encryptionMethod"];
    
    if (!empty($inputText)) {
        $outputText = encryptText($inputText, $selectedMethod);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encryption</title>
</head>
<body>
    <div class="container">
        <textarea placeholder="Input Text To Encrypt" class="inputText" name="inputText" form="encryptionForm"></textarea>
        <form action="" method="post" id="encryptionForm">
            <select name="encryptionMethod">
                <option value="69">69</option>
                <option value="Stingy">Stingy</option>
            </select>
            <button type="submit">Proceed</button>
        </form>
        <textarea disabled placeholder="output..." name="outputText"><?php echo $outputText; ?></textarea>
    </div>
<style>
body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(45deg, #007ffc, #800080); 
}

.container {
    text-align: center;
    width: 80%;
}

textarea {
    color: white;
    border-radius: 20px;
    box-shadow: rgba(255, 255, 255, 0.2) 0px 1px 4px!important;
    width: 100%;
    height: 150px;
    margin: 10px 0;
    padding: 20px;
    font-size: 1.2em;
    resize: none;
    box-sizing: border-box;
    border: 1px solid #ccc;
    display: block;
}

select {
    border-radius: 20px;
    box-shadow: rgba(255, 255, 255, 0.2) 0px 1px 4px!important;
    padding: 8px;
    margin-bottom: 10px;
    font-size: 1.1em;
}

button {
    border-radius: 20px;
    box-shadow: rgba(255, 255, 255, 0.2) 0px 1px 4px!important;
    display: block;
    padding: 12px;
    margin: 10px 0;
    background-color: #4CAF50;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 1.2em;
}

select, button {
    box-sizing: border-box;
    width: 100%;
}

.inputText{
    background: #404040;
}
::placeholder{
    color: #ffffff;
}
</style>
</body>
</html>

