<?php
    /*script will send invite status to db  0 for not attending and 1 for attending*/
    $isAttendingJson='{"userId":"1","eventId":"26","attending":"1"}';

    $isAttending=json_decode($isAttendingJson);

    $userId=$isAttending->userId;
    $eventId=$isAttending->eventId;
    $isAttending=$isAttending->attending;

    $connection=mysqli_connect("localhost","cl27-rajat","rajat","cl27-rajat");
    if(!$connection){
        die("cannot connect to db");
    }

    /*check existance of userId and eventId in invitation table*/
    $searchQuery='select eventId, userId from Invited_To_Events where eventId="'.$eventId.'"AND userId="'.$userId.'"';
    $searchQueryResult=mysqli_query($connection,$searchQuery);
    if(!$searchQueryResult){
        die("Problem executing the read query");
    }
    else {
        $rowCount = mysqli_num_rows($searchQueryResult);

        /*row found means data exists already*/
        if ($rowCount > 0) {
            //record found
            $updateQuery = "UPDATE Invited_To_Events SET ";
            $updateQuery .= "attending='$isAttending' ";
            $updateQuery .= "WHERE userId='$userId'";
            $updateQueryResult=mysqli_query($connection,$updateQuery);
            if(!$updateQueryResult){
                die("problem executing update query");
            }

            echo "Update successful";
        }
        else{
            die ("record not found");
        }

    }

?>