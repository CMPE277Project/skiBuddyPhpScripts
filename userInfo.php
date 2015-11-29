<?php
    /*this script takes user data when he logs in and pushes it to user table*/

    //sample json string for testing purpose
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

            /*row found means data exists already*/
            if($rowCount > 0){
               /*do nothing*/
            }
            else{
               $insertQuery = "INSERT INTO User(firstName,lastName)";
                $insertQuery.= "VALUES ('$firstname', '$lastname')";
                $insertQueryResult=mysqli_query($connection,$insertQuery);
                if(!$insertQueryResult){
                    die("problem executing insert query");
                }

                echo "Insert successful";
            }
        }


    }
?>