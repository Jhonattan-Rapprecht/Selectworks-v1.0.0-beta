<?php
// Simple Seeder Dashboard
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seeder Dashboard</title>
</head>
<body>

<h2>Seed Kandidaten Table</h2>

<form action="runSeeder.php" method="POST">

    <label>Aantal records:</label><br>
    <select name="count">
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="500">500</option>
        <option value="1000">1000</option>
    </select>
    <br><br>

    <label>Type data:</label><br>
    <select name="type">
        <option value="basic">Basic Random</option>
        <option value="dutch">Realistic Dutch Profiles</option>
        <option value="it">IT Professionals</option>
        <option value="noise">Random Noise / Stress Test</option>
    </select>
    <br><br>

    <button type="submit">Generate Data</button>

</form>

</body>
</html>
