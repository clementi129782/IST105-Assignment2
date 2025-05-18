<?php
$resultData = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $a = escapeshellarg($_POST["a"]);
    $b = escapeshellarg($_POST["b"]);
    $c = escapeshellarg($_POST["c"]);

    $command = "python3 calculate.py $a $b $c";
    error_log("Executing command: $command");
    $result = shell_exec($command);
    error_log("Result from python: $result");

    $decoded_results = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $error = "Invalid JSON returned from Python.";
    } elseif (isset($decoded_results['error'])) {
        $error = $decoded_results['error'];
    } else {
        $resultData = $decoded_results;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment #2</title>
</head>
<body>
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
    <?php else: ?>
        <form method="post">
            <input type="text" name="a" placeholder="Enter the number of a" required>
            <input type="text" name="b" placeholder="Enter the number of b" required>
            <input type="text" name="c" placeholder="Enter the number of c" required>
            <button type="submit">Submit</button>
        </form>
    <?php endif; ?>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <?php if ($error): ?>
            <p style="color:red;">Error: <?= htmlspecialchars($error) ?></p>
        <?php else: ?>
            <h1>Assignment #2</h1>
            <h2>Todaka</h2>
            <h2>Final Result: <?= htmlspecialchars($resultData["s5"]) ?></h2>
            <p>Step 1: c = <?= htmlspecialchars($_POST["c"]) ?>, c<sup>3</sup> = <?= htmlspecialchars($resultData["s1"]) ?></p>
            <p>Step 2: √c<sup>3</sup> = <?= htmlspecialchars($resultData["s2"]) ?></p>
            <p>Step 3: <?= htmlspecialchars($resultData["s2"]) ?> / <?= htmlspecialchars($_POST["a"]) ?> = <?= htmlspecialchars($resultData["s3"]) ?></p>
            <p>Step 4: <?= htmlspecialchars($resultData["s3"]) ?> * 10 = <?= htmlspecialchars($resultData["s4"]) ?></p>
            <p>Step 5: <?= htmlspecialchars($resultData["s4"]) ?> + <?= htmlspecialchars($_POST["b"]) ?> = <?= htmlspecialchars($resultData["s5"]) ?></p>
            <p><b>Calculation completed at <?= date("Y-m-d H:i:s") ?></b></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
