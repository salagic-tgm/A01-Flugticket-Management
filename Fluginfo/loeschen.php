<?php
$ini = parse_ini_file('conf.ini');
	
	$db = $ini['db_name'];  
	$user = $ini['db_user'];  
	$password = $ini['db_password']; 
	

if (!isset($_GET['id']))
{
    echo 'No ID was given...';
    exit;
}

$con = new mysqli('localhost', $user, $password,$db);
if ($con->connect_error)
{
    die('Verbindungs Fehler(' . $con->connect_errno . ') ' . $con->connect_error);
}

$sql = "DELETE FROM passengers WHERE id = ?";

if (!$result = $con->prepare($sql))
{
    die('Query failed: (' . $con->errno . ') ' . $con->error);
}

if (!$result->bind_param('i', $_GET['id']))
{
    die('Binding parameters failed: (' . $result->errno . ') ' . $result->error);
}

if (!$result->execute())
{
    die('Execute failed: (' . $result->errno . ') ' . $result->error);
}

if ($result->affected_rows > 0)
{
    echo "Der Passagier wurde gelöscht!";
}
else
{
    echo "Konnte die ID nicht entfernen..";
}
$result->close();
$con->close();
?>
</br>
<a href="flugbuchung.php">Back

</a>