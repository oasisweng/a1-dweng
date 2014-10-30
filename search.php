
<html>
<head>
<Title>Registration Form</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Search here!</h1>
<p>Fill in your name ,email address and company name, then click <strong>Submit</strong> to search.</p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Name  <input type="text" name="name" id="name"/></br>
      Email <input type="text" name="email" id="email"/></br>
      Company Name <input type="text" name="company_name" id="company_name"/></br>
      <input type="submit" name="submit" value="Search" />
</form>
<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "us-cdbr-azure-east2-d.cloudapp.net";
    $user = "bad3b986574597";
    $pwd = "7911617c";
    $db = "a1dweng";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }

    if(!empty($_POST)) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $company_name = $_POST['company_name'];
        // Search data
        $sql_search = "SELECT * FROM registration_tbl WHERE name LIKE '%".$name."%' OR email LIKE '%".$email."%' OR company_name LIKE '%".$company_name."%'";
        $stmt = $conn->query($sql_search);
        $results = $stmt->fetchAll();
        echo "<p> Search results </p>";
        if(count($results) > 0) {
            echo "<table>";
            echo "<tr><th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Company Name</th>";
            echo "<th>Date</th></tr>";
            foreach($result as $results) {
                echo "<tr><td>".$search_rs['name']."</td>";
                echo "<td>".$search_rs['email']."</td>";
                echo "<td>".$search_rs['company_name']."</td>";
                echo "<td>".$search_rs['date']."</td></tr>";
            } 
            echo "</table>";
        } else {
            echo "No results found";
        }
    }

?>

</body>
</html>
