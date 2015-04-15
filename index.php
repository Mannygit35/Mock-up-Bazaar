<?php session_start(); ?>
<!--
    
    Home page for the user. Displays their info if they are a student or alumni.
    Otherwise redirects to admin or advertiser home pages.


    Website layout - Matthew Leonard
    Advertisements - Dakota Slay
    Home page - Jose Hernandez and Priscilla Paz


-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="newcss.css">
        <title>UTA University Bazaar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <style>
            #adColumn
            {
                -moz-column-count: 1;
                -moz-column-width: 100px;
                -moz-column-rule: 1px solid darkorange;
                -webkit-column-count: 1;
                -webkit-column-width: 100px;
                -webkit-column-rule: 1px solid darkorange;
            }
            Table
            {
                border-collapse:collapse;
                border: 2px solid black;
            }
            #userhome
            {
                font-size:20px;
            }
            
        </style>
    </head>
    
    <body>
        <div id="headerBar1">UTA UNIVERSITY BAZAAR</div>
        <div id="headerBar2"></div>
        
        <div id="navBar"> <!--Navigation Bar-->
    
        <ul id="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="displayBulletin.php">Bulletin</a></li>
            <li><a href="inbox.php">Messages</a></li>
            <li><a href="http://localhost/marketpostlist.php">Market</a></li>
            <li><a href="http://localhost/exchangelist.php">Exchange</a></li>
            <li><a href="http://localhost/grouplist.php">Groups</a></li> 
            <li><a href="http://localhost/new_user_login.html">Logout</a></li> 
        </ul>
        </div>
        
        <div id="headerBar4"></div>
    
        <div id="adColumn"> 
            <?php
        //Advertisements
    $mysqlconnect=mysql_connect("127.0.0.1:3306","root","");
    mysql_select_db("bazaar");
    $mysqlselect="select * from ads;";
    $result=mysql_query($mysqlselect);
    $ads = array();
    $index = 0;
    while($row = mysql_fetch_array($result))
    {
      $ads[$index] = $row['Image'];
      $index++;
    }
    $randomPost = rand(1, count($ads)-1);
    echo "$ads[$randomPost]";
   ?> </div>
    
        <div id="main">
        <p>
<?php 




        //connect to database
        $mysqlconnect=mysql_connect("127.0.0.1:3306","root","");
 
        //check if connection failed
	if(!$mysqlconnect)
	{
		die("Unable to Connect !!".mysql_error());
	}
	
        //select database
	mysql_select_db("bazaar");

        //get user name and type
        $username = $_SESSION['username'];
        $type = $_SESSION['type'];


//if student or alumni display info
if($type == "student" || $type == "alumni")
{
        //get info
	$query = "SELECT * FROM user where username = '$username';";
	$result = mysql_query($query);
	
        //Display user info
	echo "<div id="."userhome".">";
	while($row = mysql_fetch_array($result))
	{
		echo "<b>User Name:</b>".$row['username'];
		echo "<br> <b>Type of User:</b>".$row['type'];
		echo "<br> <b>Email:</b>".$row['email'];
		echo "<br> <b>About Me:</b> <br>".$row['personal_info'];
	}
	
	echo "</div>";
	
        //Diplay reviews about the user
	$query = "SELECT * FROM reviews where uID = '$username';";
	$result = mysql_query($query);
        
        echo "<Table border =1>";
        echo "<tr>";
        echo "<th> Reviewer </th>";
        echo "<th> Rating </th>";
        echo "<th> Comments </th>";
        echo "</tr>";
        
		while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>".$row['reviewerID']."</td>";
		echo "<td>".$row['rating']."</td>";
		echo "<td>".$row['comments']."</td>";
		echo "</tr>";
		
	}

echo "</Table>";
	
	
}
else if($type == "admin") //redirect to admin page
	{
		echo "<script> window.location.replace(\"http://localhost/adminHome.php\"); </script>";
	}
	else if($type == "advertiser") //redirect to advertiser page
	{
		echo "<script> window.location.replace(\"http://localhost/adIndex.php\"); </script>";
	}
?>


		</p>
        <br>
        
        </div>
    </body>
</html>
