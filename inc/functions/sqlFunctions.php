<?php
function getTotalPrice($num, $conn){
    $query = "SELECT SUM(an.prixA) AS prixTotal FROM test t INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse an ON dt.idAnalyse = an.idAnalyse WHERE t.numTest='".$num."'";
    $q = $conn->query($query);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $Count = $q->rowCount();
    while($row= $q->fetch()) {
        $total = $row['prixTotal'];
    }
    return $total;
}
function checkStatus($id,$defult,$location,$conn){
   $query = "SELECT * FROM `test` WHERE numTest='".$id."'";
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $q->rowCount();
            while($row= $q->fetch())$status = $row['status'];
          if($status!=$defult || $Count==0) {
            echo("ERROR");
            header("Refresh: 5; url=".$location);
         
               exit();
             
          }
}
function getVilles($default) {
    $cities = array("Select","Annaba","Berrahal","El Hadjar","Eulma","El Bouni","Oued El Aneb",
        "Cheurfa","Seraïdi","Aïn Berda","Chetaïbi","Sidi Amar","Treat");
    $output = '<select name="ville" required>';
    foreach ($cities as $city) {
        $output .= '<option';
        if ($city == $default) {
            $output .= ' selected';
        }
        if ($city == "Select") {
            $output .= ' disabled';
        }
        $output .= '>' . $city . '</option>';
    }
    $output .= '</select>';
    echo $output;
}
?>