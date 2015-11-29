<?php
    /*this script will grab user data when requested from User table
     this will be useful when we want to view user profile
     */

     $userDataInJson='{ "firstname" : "hemant" , "lastname" : "bansal" }';

         $userData=json_decode($userDataInJson);

         $firstname=$userData->firstname;
         $lastname=$userData->lastname;

         $connection=mysqli_connect("localhost","cl27-rajat","rajat","cl27-rajat");
         if(!$connection){
             die("cannot connect to db");
         }
         else{

             $readQuery='select * from User where firstName="'.$firstname.'"AND lastName="'.$lastname.'"';
             $queryResult=mysqli_query($connection,$readQuery);
             if(!$queryResult){
                 die("Problem executing the read query");
             }
             else{
                 $rowCount=mysqli_num_rows($queryResult);

                 /*row found means data exists*/
                 if($rowCount > 0){
                    while($row = mysqli_fetch_assoc($queryResult)) {
                            //echo 'first name:'.$row['firstName'].'last name:'.$row['lastName'].'image id:'.$row['image_id'];

                            $userProfileInfo=array('firstName' =>$row['firstName'],
                                            'lastname'=>$row['lastName'],
                                             'image_id' => $row['image_id']);
                        }

                                echo json_encode($userProfileInfo);
                 }
                 else{

                     echo "Record not found";
                 }
             }


         }

?>