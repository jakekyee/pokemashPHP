<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="pokemash.css">
        
        <title>Pokemash</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        
        

    </head>
    
    
    
    <body>
        <div class="navbar">
            <ul>
<!--            <li><img src="pokemon/151.png" alt="mew"/></li>-->
            <li><h1>Pokemash</h1></li>

            </ul>
        </div>
        
        
               <?php
        $numberOne = sprintf('%03d', rand(1, 807));
        $numberTwo = sprintf('%03d', rand(1, 807));
        while ($numberOne == $numberTwo) {
            $numberTwo = sprintf('%03d', rand(1, 807));
        }
        

        echo $numberOne;
        echo $numberTwo;
        
        
        function placeVote() {
            
        }

        ?>
        <style>

            .content{
                display: block;
                width: 70%;
                margin:auto;
                padding:10px;
                
            }
            
            #pokemonPic {
                width:100%;
                height: auto;
                
            }
            #pick {
                background:transparent;
                border:none;
                outline:none;
                
            }
        </style>
        
    
        
        <div class = "middle">
            
        <div class ="content">
            <table style = "width:50%">
                <tr>
                    <td>
            <div class ="leftstuff">
                <form action="vote.php" method="get">
                    <input type="text" value="<?php echo $numberOne?>" name ="winner" style="display:none;">
                    <input type="text" value="<?php echo $numberTwo?>" name ="loser" style="display:none;">
                    <button type="submit"  id="pick">
                    <img src="pokemon/<?php echo $numberOne?>.png" id="pokemonPic">
                    </button>
                </form>
            </div>
                    </td>
                    <td>
                <h1> OR </h1>
            </td>
            <td>
            <div class="rightstuff">
                <form action="vote.php" method="get">
                    <input type="text" value="<?php echo $numberTwo?>" name ="winner" style="display:none;">
                    <input type="text" value="<?php echo $numberOne?>" name ="loser" style="display:none;">
                    <button type="submit" id="pick">
                    <img src="pokemon/<?php echo $numberTwo?>.png" id="pokemonPic">
                    </button>
                </form>
            </div>
                </td>
            </tr>
            </table>



            
        </div>

         
            <?php
            
$winner =  $_GET["winner"];
$loser = $_GET["loser"];            
            
            
            
            
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

$sqlQueryWinner = "SELECT * FROM pokemon WHERE number = '$winner'";
$sqlQueryLoser = "SELECT * FROM pokemon WHERE number = '$loser'";
$resultWinner = $conn->query($sqlQueryWinner);
$resultLoser = $conn->query($sqlQueryLoser);

$winnerInfo = $resultWinner->fetch_assoc();
$winnerName = $winnerInfo["name"];
$winnerElo = $winnerInfo["elo"];

$loserInfo = $resultLoser->fetch_assoc();
$loserName = $loserInfo["name"];
$loserElo = $loserInfo["elo"];

//Expected results
$expectedWinner = 1/(1+(10**(($winnerElo - $loserElo)/400)));
$expectedLoser = 1/(1+(10**(($loserElo - $winnerElo)/400)));
$Kvalue = 40;


$winnerUpdate = $winnerElo + ($Kvalue*(1-$expectedWinner));
$loserUpdate = $loserElo + ($Kvalue*(0-$expectedLoser));
echo "<br> $winnerName, $winnerElo, $loserName, $loserElo";
echo "<br> $winnerUpdate, $loserUpdate";

$sqlUpdateWinner = "UPDATE pokemon SET elo = '$winnerUpdate' WHERE number = '$winner';";
$sqlUpdateLoser = "UPDATE pokemon SET elo = '$loserUpdate' WHERE number = '$loser';";
$conn->query($sqlUpdateWinner);




if ($conn->query($sqlUpdateLoser) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

if ($conn->query($sqlUpdateWinner) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}


echo $sqlUpdateWinner;
echo $sqlUpdateLoser;
  ?>

            
            
            
     

         
        </div>
    </body>
</html>

