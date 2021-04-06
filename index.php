<?php
require_once 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $lastname = trim($_POST['lastname']);

    $firstname = trim($_POST['firstname']);

    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";

    $statement = $pdo->prepare($query);
    
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    $statement->bindValue(':firstname', $limit, \PDO::PARAM_STR);
    
    $statement->execute();

    header('location: index.php');
    
if (!empty($_GET) && isset($_GET['submit'])) 
{
    $data = array_map('trim', $_GET);
 
    // Déclaration des variables
    $name = $data['lastname'];
    $firstname = $data['firstname'];

    if (empty($name)) {
        $errors[] = 'Le nom est manquant';
    }
    
    if (empty($firstname)) {
        $errors[] = 'Le prénom est manquant';
    }
    
    if (strlen($name)>45){
        $errors[]= "Le Nom est trop long";
    }

    if (strlen($name)>45){
        $errors[]= "Le Prenom est trop long";
    }
    
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach($friends as $friend) :?>
            <li>
             <?= $friend['firstname'] . ' ' . $friend['lastname']; ?>
            </li>
        <?php endforeach ?>
    </ul>
    <form action="" method="POST">

        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" id="firstname"/>

        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" id="lastname"/>

        <button>Submit</button>
    </form>
        
</body>
</html>