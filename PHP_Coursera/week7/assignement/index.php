<style>
    input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #1f38ff;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #55b6ff;
    }

    label {
        font-family: Verdana;
        font-size: 2rem;
    }

    @media all and (min-width: 750px) {
        input[type=text] {
            width: 50%;
        }

        input[type=submit] {
            width: 50%;
        }
    }
</style>


<div>
    <form action="index.php" method="get">
        <label>Write your MD5 value : <br> <input name="md5" size="40" type="text"></label>
        <br>
        <input type="submit" value="send">
    </form>
</div>
<?php
$test = hash("md5", "0012");
echo $test;
if (isset($_GET["md5"])) {
    $md5 = $_GET["md5"];
    $time_pre = microtime(true);
    for ($i = 0; $i <= 9999; $i++) {
        $ch = strval($i);
        if ($i < 10) {
            $ch = str_pad($ch, strlen($ch) + 3, "0", STR_PAD_LEFT);
        } elseif ($i < 100)
            $ch = str_pad($ch, strlen($ch) + 2, "0", STR_PAD_LEFT);
        elseif ($i < 1000)
            $ch = str_pad($ch, strlen($ch) + 1, "0", STR_PAD_LEFT);
        $code = hash("md5", $ch);
        if ($i < 15) {
            echo "<pre>$code $ch\n</pre>";
        }
        if ($code == $md5) {
            break;
        }
    }
    if ($code == $md5) {
        echo "<p>PIN: $ch</p>";
    } else {
        echo "<p>PIN: Not found</p>";
    }
}

?>