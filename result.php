<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $a = escapeshellarg($_GET["a"]);
        $b = escapeshellarg($_GET["b"]);
        $c = escapeshellarg($_GET["c"]);

        $command = "python3 /var/www/html/calculate.py $a $b $c";
        $result = shell_exec($command);

        $decoded_results = json_decode($result, true);

        if (isset($decoded_results['error'])) {
            $error = $decoded_results['error'];
        } else {
            $s1 = $decoded_results['s1'];
            $s2 = $decoded_results['s2'];
            $s3 = $decoded_results['s3'];
            $s4 = $decoded_results['s4'];
            $s5 = $decoded_results['s5'];
        }        
    } else {
        exit("Invalid request.");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assignment #2 Result</title>
    </head>
    <body>
    <?php if (isset($error)): ?>
        <p style="color: red;">Error: <?= htmlspecialchars($error) ?></p>
    <?php else: ?>
        <h1>Assignment #2</h1>
        <h2>Todaka</h2>
        <h2>Final Result: <?= htmlspecialchars($s5) ?></h2>
        <p>Step 1: c= <?= htmlspecialchars($_GET["c"]) ?>, c<sup>3</sup>=<?= htmlspecialchars($s1) ?></p>
        <p>Step 2: √c<sup>3</sup>=<?= htmlspecialchars($s2) ?></p>
        <p>Step 3: <?= htmlspecialchars($s2) ?> / <?= htmlspecialchars($_GET["a"]) ?>=<?= htmlspecialchars($s3) ?></p>
        <p>Step 4: <?= htmlspecialchars($s3) ?> * 10 = <?= htmlspecialchars($s4) ?></p>
        <p>Step 5: <?= htmlspecialchars($s4) ?> + <?= htmlspecialchars($_GET["b"]) ?>=<?= htmlspecialchars($s5) ?></p>
        <p><b>Calculation completed at <?= date("Y-m-d H:i:s") ?></b></p>
    <?php endif; ?>
    </body>
</html>