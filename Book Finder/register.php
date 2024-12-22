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
$emri = $_POST['emri'];
$email = $_POST['email'];
$fjalkalimi = $_POST['fjalkalimi'];

// Kripto fjalëkalimin
$fjalkalimi_kript = password_hash($fjalkalimi, PASSWORD_DEFAULT);

// Përgatitja e SQL për regjistrim
$sql = "INSERT INTO perdoruesi (emri, email, fjalekalimi) VALUES ('$emri', '$email', '$fjalkalimi_kript')";

if ($conn->query($sql) === TRUE) {
    echo "Regjistrimi u krye me sukses!";
} else {
    echo "Gabim: " . $sql . "<br>" . $conn->error;
}

// Mbyll lidhjen
$conn->close();
?>