<?php
    /*this script will give info about event*/

/*sample json for testing. Assumption: event id will come from android*/
$eventIdAsJson='{"eventId":"26"}';
$eventId=json_decode($eventIdAsJson);
$eventId=$eventId->eventId;

$connection=mysqli_connect("localhost","cl27-rajat","rajat","cl27-rajat");
if(!$connection){
    die("cannot connect to db");
}
else{

    $readQuery='select * from Event where eventId="'.$eventId.'"';
    $queryResult=mysqli_query($connection,$readQuery);
    if(!$queryResult){
        die("Problem executing the read query");
    }
    else{
        $rowCount=mysqli_num_rows($queryResult);

        /*row found means data exists*/
        if($rowCount > 0){
            while($row = mysqli_fetch_assoc($queryResult)) {


                $eventInfo=array('eventId' =>$row['eventId'],
                    'title'=>$row['title'],
                    'description' => $row['description'],
                    'eventDate' => $row['eventDate'],
                    'endTime' => $row['endTime'],
                    'ownerId' => $row['ownerId']
                );
            }

            echo json_encode($eventInfo);
        }
        else{

            echo "Record not found";
        }
    }

}



?>