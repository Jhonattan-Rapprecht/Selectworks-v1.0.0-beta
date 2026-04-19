<?php
$c = new mysqli('127.0.0.1', 'root', 'root', 'selectworks');

// Add profile-related columns if they don't exist
$adds = [
    "ALTER TABLE kandidaten ADD COLUMN IF NOT EXISTS biografie TEXT DEFAULT NULL AFTER wachtwoord",
    "ALTER TABLE kandidaten ADD COLUMN IF NOT EXISTS profielfoto VARCHAR(255) DEFAULT NULL AFTER biografie",
    "ALTER TABLE kandidaten ADD COLUMN IF NOT EXISTS functie_titel VARCHAR(150) DEFAULT NULL AFTER profielfoto",
    "ALTER TABLE kandidaten ADD COLUMN IF NOT EXISTS linkedin VARCHAR(255) DEFAULT NULL AFTER functie_titel",
];
foreach ($adds as $sql) {
    $c->query($sql);
    if ($c->error) echo "WARN: " . $c->error . "\n";
}
echo "Schema updates done.\n\n";

$r = $c->query('DESCRIBE kandidaten');
while ($row = $r->fetch_assoc()) {
    echo $row['Field'] . ' | ' . $row['Type'] . ' | ' . $row['Null'] . ' | ' . $row['Default'] . "\n";
}
$c->close();
