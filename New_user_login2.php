<?php session_start(); ?>
<!--
	Author: Jose Hernandez
    Created on : Mar 31, 2014, 12:55:48 PM

    References for learning HTML material largely from w3schools.com
	
	this code is if you are a returing user. So it checks if your username and password match.

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
  
 
 <?php
 // connect to the database
 $mysqlconnect=mysql_connect("127.0.0.1:3306","root","");
	if($mysqlconnect)
	{
		
	}
	else
	{
		die("Unable to Connect !!".mysql_error());
	}
	
	mysql_select_db("bazaar");
 
 
 // gget the username and password for New_user_login.html and assign variables to them.
 $username22 = $_REQUEST['username22'];
$password22 = $_REQUEST['password22'];

$query = "SELECT * FROM user WHERE username='$username22'";

 $result = mysql_query($query);
 
// compare if the database has the same username and password.
  if (mysql_num_rows($result) != 0)
  {
       $query = "SELECT password,type FROM user WHERE username='$username22'";

	   $result = mysql_query($query);
	   
	   while($row = mysql_fetch_array($result))
	   {
	   // if the username and password match then allow access into the main webpage
			if($password22 == $row['password'])
			{
				$_SESSION['username'] = $username22;
				$_SESSION['type'] = $row['type'];
				header( 'Location: index.php');
			}
			// if the username and password are wrong then the user will not be allowed access
			else
			{
				header( 'Location: New_user_login.html ');
			}
	   }
	 
	
  }
  else
  {
    
	
	
	header( 'Location: New_user_login.html ');
  }
 
 
 
 

 
 
 
 






// insert hyperlink here to go to the main webpage.


?><br>
		
		
        
    </body>
</html>