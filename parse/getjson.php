<?php 
$json = '{
    "persName": {
        "forename": "M",
        "surname": "Gilvy"
    },
    "affiliation": {
        "@attributes": {
            "key": "aff0"
        },
        "orgName": [
            "Faculty of Computer Science",
            "University of Brawijaya"
        ],
        "address": {
            "country": "Indonesia"
        }
    }
}';

$yummy = json_decode($json);

$namabelakang= $yummy->persName->surname;
$namadepan= $yummy->persName->forename;

echo "$namadepan $namabelakang";

?>