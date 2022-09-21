<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>  

            <?php
$username = "root";
$password = "root";
echo "<br>"+$password ;
echo "test" ;
// Create connection
$conn = new mysqli("localhost", $username, $password, "numbers");
// Check connection
echo "Check :)" ;
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "connection die"; 
}
echo "connected :)" ;



$sqlQuery = "SELECT * FROM pokemon";
$sqlQueryLoser = "SELECT * FROM pokemon WHERE number = '$loser'";
$resultWinner = $conn->query($sqlQueryWinner);
$resultLoser = $conn->query($sqlQueryLoser);

$winnerInfo = $resultWinner->fetch_assoc();
$winnerName = $winnerInfo["name"];
$winnerElo = $winnerInfo["elo"];

$loserInfo = $resultLoser->fetch_assoc();
$loserName = $loserInfo["name"];
$loserElo = $loserInfo["elo"];

echo "<br> $winnerName, $winnerElo, $loserName, $loserElo";

  ?>

</body>
</html>
