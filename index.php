<?php
include_once 'Warehouse.php';

define('QUERY_TABLE', "SELECT `height`, `length`, `width` 
              FROM `product`
              WHERE `height` <= 3600
              ORDER BY `width` DESC;");

try {
    $connection = new DbConnection();
    $db = $connection->getConnection();

    $stmt = $db->prepare(QUERY_TABLE);
    $stmt->execute();

    $dimensions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    findDimensions($dimensions);

} catch (Exception $e){
    echo $e->getMessage() . "<br />";
}

function findDimensions($dimensions){
    foreach ($dimensions as $dimension){
        Warehouse::insertProduct($dimension);
    }

    Warehouse::printDimensions();
}
