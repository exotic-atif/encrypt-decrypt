<?php
function decryptText($text, $method) {
    switch ($method) {
        case "69":
            $binary_representation = str_replace(['6', '9'], ['0', '1'], join('', explode(':', $text)));
            return join('', array_map(function ($binary_char) {
                return chr(bindec($binary_char));
            }, str_split($binary_representation, 8)));

        case "Scramble":
            // Decryption for scramble isn't straightforward as it's randomized.
            // A direct decryption method isn't provided here. 
            return "Scramble decryption is not deterministic.";

        case "Stingy":
            $shift = -3;
            $result = '';
            foreach (str_split($text) as $char) {
                if (ctype_alpha($char)) {
                    $ascii = ord(ctype_upper($char) ? 'A' : 'a');
                    $result .= chr($ascii + (ord($char) - $ascii + $shift + 26) % 26);
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
    $selectedMethod = $_POST["decryptionMethod"];
    
    if (!empty($inputText)) {
        $outputText = decryptText($inputText, $selectedMethod);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decryption</title>
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
</head>
<body>
    <div class="container">
        <textarea class="inputText"  placeholder="Input Encrypted Text For Decryption!" name="inputText" form="decryptionForm"></textarea>
        <form action="" method="post" id="decryptionForm">
            <select name="decryptionMethod">
                <option value="69">69</option>
                <option value="Stingy">Stingy</option>
            </select>
            <button type="submit">Proceed</button>
        </form>
        <textarea disabled placeholder="Decrypted Message!" name="outputText"><?php echo $outputText; ?></textarea>
    </div>
</body>
</html>
