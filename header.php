<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once '_connec.php';

    $pdo = new \PDO(DSN, USER, PASS);

    // A exécuter afin de tester le contenu de votre table friend
    $query = "SELECT * FROM friend";
    $statement = $pdo->query($query);
    ?>

    <h1>Here is your new list of friends!</h1>

    <ul>
        <?php
        // On veut afficher notre résultat via un tableau associatif (PDO::FETCH_ASSOC)
        $friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($friendsArray as $friend) {
            echo "<li>";
            echo $friend['firstname'] . ' ' . $friend['lastname'];
            echo "</li>";
        }
        ?>
    </ul>
</body>

</html>