<?php

function generateCandidate($type = 'basic') {

    $voorletters = chr(rand(65, 90)) . ".";
    $achternamen = ["Jansen", "De Vries", "Bakker", "Visser", "Smit", "Mulder", "Meijer"];
    $straatnamen = ["Dorpsstraat", "Kerklaan", "Laan van Meerdervoort", "Stationsweg", "Hoofdstraat"];
    $woonplaatsen = ["Rotterdam", "Den Haag", "Amsterdam", "Utrecht", "Eindhoven"];

    $achternaam = $achternamen[array_rand($achternamen)];
    $straatnaam = $straatnamen[array_rand($straatnamen)];
    $woonplaats = $woonplaatsen[array_rand($woonplaatsen)];

    $email = strtolower($voorletters[0] . $achternaam . rand(100, 999)) . "@example.com";

    $base = [
        'Voorletters' => $voorletters,
        'Achternaam' => $achternaam,
        'Geboortedatum' => rand(1970, 2005) . "-" . rand(1, 12) . "-" . rand(1, 28),
        'Geslacht' => rand(0, 1) ? 'man' : 'vrouw',
        'Straatnaam' => $straatnaam,
        'Huisnummer_toevoeging' => rand(1, 200),
        'Postcode' => rand(1000, 9999) . chr(rand(65, 90)) . chr(rand(65, 90)),
        'Woonplaats' => $woonplaats,
        'Telefoonnummer' => "06" . rand(10000000, 99999999),
        'Email' => $email,
        'Wachtwoord' => password_hash("Welkom123", PASSWORD_DEFAULT)
    ];

    // Type-specific overrides
    if ($type === 'dutch') {
        $base['Achternaam'] = ["Jansen", "De Vries", "Van Dijk", "Bakker", "Hoekstra"][array_rand(["Jansen", "De Vries", "Van Dijk", "Bakker", "Hoekstra"])];
    }

    if ($type === 'it') {
        $base['Achternaam'] = ["DevOps", "Backend", "Frontend", "Cloud", "Engineer"][array_rand(["DevOps", "Backend", "Frontend", "Cloud", "Engineer"])];
        $base['Woonplaats'] = ["Amsterdam", "Utrecht", "Eindhoven"][array_rand(["Amsterdam", "Utrecht", "Eindhoven"])];
    }

    if ($type === 'noise') {
        $base['Voorletters'] = substr(md5(rand()), 0, 2);
        $base['Achternaam'] = substr(md5(rand()), 0, 8);
        $base['Email'] = substr(md5(rand()), 0, 10) . "@spam.test";
    }

    return $base;
}
