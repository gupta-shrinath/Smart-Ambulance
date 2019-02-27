<?php
    include '../database.php';
    $aid = 1;
    $latitude = 0;
    $longitude = 0;
    $sql1 = "select * from ambulance_data WHERE A_ID=$aid";
    $res1 = mysqli_query($con,$sql1);
    /*while ($row = mysqli_fetch_assoc($res1)) 		
    {
        $latitude = $row['Latitude']; 
        $longitude = $row['Longitude']; 
    }*/
    $result_array = array();
    $result = $con->query($sql1);

    if ($result->num_rows > 0) {
    
        while($row = $result->fetch_assoc()) {
    
            array_push($result_array, $row);
    
        }
    
    }

/* send a JSON encded array to client */
echo json_encode($result_array);

$con->close();
 ?>