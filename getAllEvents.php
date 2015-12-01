<?php
    $connection=mysqli_connect("localhost","cl27-rajat","rajat","cl27-rajat");
    if(!$connection){
        die("cannot connect to db");
    }

    $readQuery='select * from Event';
    $readQueryResult=mysqli_query($connection,$readQuery);
    if(!$readQueryResult){
        die("Problem executing the read query");
    }
    else {
        $rowCount = mysqli_num_rows($readQueryResult);

        /*row found means data exists*/
        if ($rowCount > 0) {
            while ($row = mysqli_fetch_assoc($readQueryResult)) {
                $eventInfo = array('eventId' => $row['eventId'],
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'eventDate' => $row['eventDate'],
                    'endTime' => $row['endTime'],
                    'ownerId' => $row['ownerId']
                );
                echo json_encode($eventInfo);
            }
        }
        else{

                echo "Record not found";
            }

    }

?>

