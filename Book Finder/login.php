<?php
$servername = "localhost"; // ose emri i serverit tuaj
$username = "root"; // emri i përdoruesit të databazës
$password = ""; // fjalëkalimi i përdoruesit të databazës
$dbname = "klienti"; // emri i databazës

// Krijo lidhjen me databazën
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}

// Merr të dhënat nga formulari
$email = $_POST['email'];
$fjalkalimi = $_POST['fjalkalimi'];

// Përgatitja e SQL për të marrë përdoruesin nga databaza
$sql = "SELECT * FROM perdoruesi WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Përdoruesi egziston, merr të dhënat
    $row = $result->fetch_assoc();

    // Kontrollo fjalëkalimin
    if (password_verify($fjalkalimi, $row['fjalekalimi'])) {
        echo "Kyçja u krye me sukses! Mirë se erdhët, " . $row['emri'] . "!";
    } else {
        echo "Fjalëkalimi i gabuar.";
    }
} else {
    echo "Përdoruesi nuk ekziston.";
}

// Mbyll lidhjen
$conn->close();
?>