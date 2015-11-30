<?php
/*Script will send invitation to all people in the user Table*/

/*Logic: -select all userids from user table and grab them as an array
         -insert those user ids along with event ids into Invited_To_Events table and store 0 value in attending field
*/

/*json for testing purpose*/
$eventInviteAsJson='{"eventId":"26"}';

$eventId=json_decode($eventInviteAsJson);

$eventId=$eventId->eventId;

$connection=mysqli_connect("localhost","cl27-rajat","rajat","cl27-rajat");
if(!$connection){
    die("cannot connect to db");
}
else {
    /*check if event id recieved exists in events table*/
    $readQueryForEvent= 'select * from Event where eventId="'.$eventId.'"';
    $readQueryResult=mysqli_query($connection,$readQueryForEvent);
    if(!$readQueryResult){
        die("Problem executing the read query");
    }
    else {
        $rowCount = mysqli_num_rows($readQueryResult);

        /*row found means data exists*/
        if($rowCount > 0){
            /*record found event exists */
            /*find user ids and store them in array*/
            $readUserIdQuery='select userId from User';
            $readUserIdQueryResult=mysqli_query($connection,$readUserIdQuery);
            $i=0;
            while($row=mysqli_fetch_assoc($readUserIdQueryResult)){
                    $userIdArray[$i]=$row['userId'];
                    $i++;
            }

            for($i=0;$i < count($userIdArray);$i++){
                $insertQuery = "INSERT INTO Invited_To_Events(eventId, userId, attending)";
                $insertQuery.= "VALUES('$eventId','$userIdArray[$i]','0')";

                $insertQueryResult=mysqli_query($connection,$insertQuery);
                if(!$insertQueryResult){
                    die("problem executing insert query");
                }

                echo "Insert successful";
            }

        }
        else{

            die("Record not found");
        }
    }
}
?>