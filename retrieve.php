<?php require_once 'classes/Data.php' ?>
<?php include "header.php" ?>

<?php
//send the post to initaite the properties
$data = new Data($_POST);
//build the query using the criteria and pagination (next & previues)
$data->configure();
//run the query and fill the results
$data->run();
?>

<?php include "footer.php" ?>


