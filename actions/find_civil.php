<?php
require 'models/Civil.php'; // Include the Civil class file
require 'daos/DAOCivil.php'; // Include the DAOCivil class file

function getCivilByIdAction(int $civilId) {
    $daoCivil = new DAOCivil($pdo);
    $civilModel = $daoCivil->findById($civilId);

    if ($civilModel) {
        $civilName = $civilModel->getNome();
        $civilEmail = $civilModel->getEmail();

        echo "Civil ID: $civilId<br>";
        echo "Name: $civilName<br>";
        echo "Email: $civilEmail<br>";
    } else {
        echo "Civil with ID $civilId not found.";
    }
}

$civilIdToRetrieve = 123; // Replace with the actual Civil ID
getCivilByIdAction($civilIdToRetrieve);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Civil Info</title>
</head>
<body>
    <h1>Civil Information</h1>
    <form method="GET">
        <label for="civilId">Enter Civil ID:</label>
        <input type="text" name="civilId" id="civilId">
        <input type="submit" value="Retrieve Civil Info">
    </form>

    <?php
    if (isset($_GET['civilId'])) {
        $civilIdToRetrieve = intval($_GET['civilId']);
        getCivilByIdAction($civilIdToRetrieve);
    }
    ?>
</body>
</html>
