<?php
/*script that will accept event info and send it to db */

    /*sample json for testing*/
   /*$eventDataInJson='{ "title" : "skiing at Tahoe" , "description" : "Join us for skiing in Tahoe",
                  "eventDate":"12-05-2015", "startTime":"0000-00-00 00:00:00","endTime":"0000-00-00 00:00:00",
                  "ownerId":"1"}';*/

    $eventDataInJson = json_decode(file_get_contents("php://input"), true);
    $eventData=json_decode($eventDataInJson);

    /*grab values from json*/
    $title=$eventData->title;
    $description=$eventData->description;
    $eventDate=$eventData->eventDate;
    $startTime=$eventData->startTime;
    $endTime=$eventData->endTime;
    $ownerId=$eventData->ownerId;

    $connection=mysqli_connect("localhost","cl27-rajat","rajat","cl27-rajat");
    if(!$connection){
        die("cannot connect to db");
    }
    else{
        $insertQuery = "INSERT INTO Event(title, description, eventDate, startTime, endTime, ownerId)";
        $insertQuery.= "VALUES('$title','$description','$eventDate','$startTime','$endTime','$ownerId')";

        $insertQueryResult=mysqli_query($connection,$insertQuery);
        if(!$insertQueryResult){
            die("problem executing insert query");
        }

        echo "Insert successful";
    }

?>