<?php
try {
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    # Preberemo vrednosti ID iz zahtevka
    $id = $_GET["id"];

    $db = new PDO("mysql:host=localhost;dbname=jokes", "root", "ep", $options);

    # SQL za izbris
    $statement = $db->prepare("DELETE FROM jokes WHERE id = :id");

    # Uporabimo predpripravljeno poizvedbo
    # $statement->bindParam(...);
    $statement->bindParam(":id", $id);

    $statement->execute();
} catch (PDOException $e) {
    echo "Prišlo je do napake: {$e->getMessage()}";
}

// Sedaj lahko naredimo avtomatično preusmeritev na seznam vseh šal
// header("Location: index.php");
// ali pa izpišemo obvestilo s povezavo
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Spletne šale: urejanje</title>
    </head>
    <body>
        <h1>Izbris</h1>
        <p>Šala je bila odstranjena. Nadaljuj na <a href='index.php'>seznam vseh</a>.</p>
    </body>
</html>


