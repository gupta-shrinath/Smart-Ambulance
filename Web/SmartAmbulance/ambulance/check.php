<html>
    <script src=”http://code.jquery.com/jquery-3.1.1.min.js”></script>

    <script>
    
setInterval(function(){
document.write("<?php
    include '../database.php';
    $aid = 1;
    $latitude = 0;
    $longitude = 0;
    $sql1 = "select * from ambulance_data WHERE A_ID=$aid";
    $res1 = mysqli_query($con,$sql1); 
    while ($row = mysqli_fetch_assoc($res1)) 		
    {
        $latitude = $row['Latitude']; 
        $longitude = $row['Longitude']; 
    }
    echo $latitude;
    echo "<br/>";
    echo $longitude;
    
?>");
}, 5000);
    </script>
    
</html>