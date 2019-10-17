<?php
try {
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    # Preberemo vrednosti iz zahtevka
    $id = $_POST["id"];
    $date = $_POST["joke_date"];
    $text = $_POST["joke_text"];

    $db = new PDO("mysql:host=localhost;dbname=jokes", "root", "ep", $options);

    # Pripravimo SQL za urejanje
    $statement = $db->prepare("UPDATE jokes SET joke_date = :date, joke_text = :text WHERE id = :id;");

    # Uporabimo predpripravljeno poizvedbo
    # $statement->bindParam(...);
    # ...
    $statement->bindParam(":date", $date);
    $statement->bindParam(":text", $text);
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
        <h1>Urejanje</h1>
        <p>Šala je bila posodobljena. Nadaljuj na <a href='index.php'>seznam vseh</a>.</p>
    </body>
</html>
