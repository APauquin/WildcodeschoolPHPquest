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

    ?>

    <ul>
        <?php

        $query = "SELECT * FROM friend";
        $statement = $pdo->query($query);
        $friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($friendsArray as $friend) {
            echo "<li>";
            echo $friend['firstname'] . ' ' . $friend['lastname'];
            echo "</li>";
        }
        ?>
    </ul>

    <?php

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        if (empty($firstname) || strlen($firstname) >= 45)
            $errors[] = "Firstname is required and must be less than 45 characters";
        if (empty($lastname) || strlen($lastname) >= 45)
            $errors[] = "Last name is required and must be less than 45 characters";
        if (empty($errors)) {
            $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
            $statement = $pdo->prepare($query);
            $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
            $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
            $statement->execute();
            header('Location: header.php');
            exit();
        }
    }

    ?>

    <?php 
    if (count($errors) > 0) : ?>
        <div>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="POST">

        <h1>ADD YOUR FRIEND TO THE LIST!</h1>
        <div>
            <label for="firstname">Firstname :</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>

        <div>
            <label for="lastname">Lastname :</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>

        <div class="button">
            <button type="submit">Submit</button>
        </div>

    </form>


</body>

</html>
