<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encrypt</title>
</head>
<body>
    <?php
    $str = "123456";
    $sha = sha1($str);
    $md5 = md5($tr);

    echo "This is a sha1 encrypted version of 123456".$sha;
    echo "<br />The lengh of the encrypted string is: <b>".strlen($sha)."</b>";
    echo "<br /><br />";
    echo "This is a md5 encrypted version of 123456".$md5;
    echo "<br />The lengh of the encrypted string is: <b>".strlen($md5)."</b>";
?>
</body> 
</html>