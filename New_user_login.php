<?php session_start(); ?>
<!--
	Author: Jose Hernandez
    Created on : Mar 31, 2014, 12:55:48 PM

    References for learning HTML material largely from w3schools.com
	
	This code checks weather or not the specified pieces of information entered for new user or current user are correct.
	

-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="newcss.css">
        <title>UTA University Bazaar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <style>
            
        </style>
    </head>
    
    <body>
        <div id="headerBar1">UTA UNIVERSITY BAZAAR</div>
        <div id="headerBar2"></div>
        
        
        
        <div id="headerBar4"></div>
 

 <!-- This is were i get the variable names from New_user_login.html and assign each to a variable. -->
 <?php $username = $_POST["username"];?> 
 <?php $passwrd = $_POST["password"];?>
 <?php $email = $_POST["email"];?>
 <?php $passwrd2 = $_POST["password2"];?>
 <?php $alumni = $_POST["alumni"];?>

 <?php $answer = $_POST["answer"];?>
 <?php $answer2 = $_POST["answer2"];?>
 <?php $answer3 = $_POST["answer3"];?>
 <?php $answer4 = $_POST["answer4"];?>
 <?php $counter = 0;?>
 
 <?php

 
 
 // check to see if the new user entered something for email field
 if($email == NULL)
 {
	echo "*** Go back and enter a value for School Email field.<br><br>";
	$counter++;
 }
 
 
 
 
 // check if the password and confirm password are corrent for new user sign up
 if((strcmp($passwrd2,$passwrd)) != 0)
 {
	echo "*** Passwords are different. Go back and enter both of them the same.<br><br>";
	$counter++;
 }
 
 
 

// get the size of the username
$size = strlen($username);

// if the size of the username entered is less than 4 they will have to re-enter one that is greater than 4 characters
if($size < 4 )
{
echo "*** Username is less than 4 characters. Go back at enter a username between 4 and 20 characters long.<br><br>";
$counter++;
}
//if the size of the username entered is greater than 20 characters they will have to anter once that is less.
if( $size > 20)
{
echo "*** Username is greater than 20 characters. Go back at enter a username between 4 and 20 characters long.<br><br>";
$counter++;
}


// get the size of the password entered by the new user sign up
$size2 = strlen($passwrd);
// password must be greater than 6 and less than 20 characters
if($size2 < 6)
{
echo "*** Password is under 6 characters. Go back and enter a password that is greater than 6 characters long.<br><br>";
$counter++;
}
if($size2 > 20)
{
echo "*** Password is greater than 20 characters. Go back and enter a password that is less than 20 characters.<br><br>";
$counter++;
}
// if the type field is blank they will have to go back and enter something for that field.
if($alumni == NULL)
{
	echo " ***Are you and alumni field is blank, go back and enter Yes or No.<br> ";
	$counter++;
}
// check to see if the user entered something for all four security questions.
if($answer == NULL)
 {
	echo "*** Go back and enter something for question 1.<br><br>";
	$counter++;
 }
 
 if($answer2 == NULL)
 {
	echo "*** Go back and enter something for question 2.<br><br>";
	$counter++;
 }
 
 if($answer3 == NULL)
 {
	echo "*** Go back and enter something for question 3.<br><br>";
	$counter++;
 }
 
 if($answer4 == NULL)
 {
	echo "*** Go back and enter something for question 4.<br><br>";
	$counter++;
 }

// if one or more pieces of information where not entered this if statement will not execute. but if everyting is entered correctly 
// then it will execute.
if($counter == 0)
{
// this is where I strip the user input for the type. so it doesn't matter is the user enters capital letters or not
 $type = "student";
 $lowercase = strtolower($alumni);
 $yes = 'yes';
 $y = 'y';
 // if new user enters yes or y they will be an alumni.
 if(((strcmp($lowercase,$yes)) == 0) || (strcmp($lowercase,$y)) == 0) 
 {
	$type = "alumni";
	echo "NOTE - You are an alumni, therefore you will only receive a subset of the functionality of the website. <br><br>";
 }
 else
 {
	echo "You are a member, you will receive full functionality of the website. <br><br>";
 }
	
	// connect the database
	$mysqlconnect=mysql_connect("127.0.0.1:3306","root","");
	if($mysqlconnect)
	{
		
	}
	else
	{
		die("Unable to Connect !!".mysql_error());
	}

	
	
// bazaar is the database
mysql_select_db("bazaar");
// inserts the input data the user entered in the database
// user is the table that has the data
$mysqlinsert="insert into user values('$_REQUEST[username]','$_REQUEST[password]','$type','$_REQUEST[email]','$_REQUEST[answer]','$_REQUEST[answer2]','$_REQUEST[answer3]','$_REQUEST[answer4]','$_REQUEST[alumni]','$_REQUEST[personal]');";
$myselectquery="select * from user;";


mysql_query($mysqlinsert);

	if(mysql_errno() == 1062){
	    echo "<script> window.alert(\"This username is already taken.\");
		       window.location.replace(\"http://localhost/New_user_login.html\"); </script>";
		print "Data is the same";
	}
$result=mysql_query($myselectquery);
mysql_query("insert into user values");
echo("<br><br>");
  echo "Click the link to go to the main page:", "<a href=index.php>Main page</a>";
 
	$_SESSION["username"] = $username;
	$_SESSION["type"] = $type;
		
	
}

// if the new user does not enter a piece if information correctly this else statement will execute.
else
{
	echo "One or more pieces of information are wrong, Can't allow access into the website until changed.";
}






?><br>
		
		
        
    </body>
</html>
