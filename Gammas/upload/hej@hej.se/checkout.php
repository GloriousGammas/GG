<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Checkout</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>

<body>

<div style="position: relative;	width: 70%; margin: 0 auto; text-align: left;">
<?php
session_start();

// Kollar ifall de finns någon session.
if(!isset($_SESSION["username"]))
{
  header( 'Location: login.php' );
echo "Välkommen ". $_SESSION["username"];
}

// Trycker på logga ut så töms sessionen och man skickas till inloggningen.
if(isset($_POST["loggaut"]))
{
  unset($_SESSION['username']); 
  setcookie('username','mm',time()-10); // Sätter en cookie som gått ut (tar bort en cookie)

  header( 'Location: login.php' );
}
?>

<center>
<h1>Uppgift 2 - Checkout</h1><br />

<a href="checkout.php"><button class="btn btn-success">Kassa</button></a>
<a href="store.php"><button class="btn btn-primary">Produkter</button></a>
</br></br>
<form method="POST" action="store.php">

<input type="submit" value="Logga ut <?php echo $_SESSION['username'] ?>" name="loggaut" class="btn btn-danger">
</form>
</center>

<table class="table table-striped">
	<thead>
		<th width="200">PRODUKT</th>
		<th width="60">PRIS</th>
		<th width="60">ANTAL</th>
	</thead>
	
<?php
$indi = $_POST['indexet'];
if($indi != '') // Kollar så att indi inte är tom, alltså har ett index-registrerats
{
	if(isset($_SESSION['varukorg'][$indi]['qty'])) //Om en produkt är registrerad sedan tidigare
	{
		if($_POST['action']=='add') // Om man tryckt på lägg till.
		{
			$_SESSION['varukorg'][$indi]['qty']++; // Antalet (quantity) ökar med 1 på just de indexet.
		}
		elseif($_POST['action'] == 'delete') // Ifall man tryckt på ta bort.
		{
			if($_SESSION['varukorg'][$indi]['qty'] > 1) // Kollar ifall det är mer än en som är registrerad.
			{
				$_SESSION['varukorg'][$indi]['qty']--; //Antalet (quantity) minskar med 1.
			}
			elseif($_SESSION['varukorg'][$indi]['qty'] <= 1) // Om det är 1 eller mindre än 1.
			{
				unset($_SESSION['varukorg'][$indi]); // Tar bort arrayen, så att de inte finns någon kvar.
			}
		}
	}
}


$totPrice = 0;

for( $i=0; $i <= $_SESSION['skivor']; $i++) // För varje skiva.
{
	if(isset($_SESSION['varukorg'][$i]['productid'])) // Om minst en produkt är registrerad 
	{
		echo "<form action='' method='post'>";
		echo "<tr><td>";
		echo $_SESSION['varukorg'][$i]['productid']; // Skriver ut titeln
		echo "</td> <td>";
		echo $_SESSION['varukorg'][$i]['price']; // Skriver ut priset
		echo "</td> <td>";
		echo $_SESSION['varukorg'][$i]['qty']; // Skriver ut antalet av produkten.
		echo "</td>";
		echo "<td width='40'>
				<input type='submit' name='action' class='btn' value='add'/> 
			</td>
			<td>
				<input type='submit' name='action' class='btn' value='delete'/> 
			</td></tr>";
		echo"	<input type='hidden' name='indexet' value='" . $i . "'/> ";
		echo "</form>";
		$totPrice = $totPrice + ($_SESSION['varukorg'][$i]['price'] * $_SESSION['varukorg'][$i]['qty']);
	}
}
?> 
<tr><td><b>Total kostnad</b></td><td><b><font color="blue"> <?php echo $totPrice; ?></b></font> </td></tr>
</table>

<form action='' method='post'>
<input type="submit" name="pay" class="btn" onclick="alertFunc()" value="Köp"/>
<script>
		function alertFunc()
		{
			alert("Tack för din beställning! Välkommen åter. ");
		}
	</script>
</form>
</div>

<?php

// Skapar orderfilen som sparas när man trycker på köp
$int = "" . 0; 
if(isset($_POST['pay']) && $totPrice >0)
{
	$name = $_COOKIE['username'];
	$filename =  "orders/" . $name . $int . '.html'; 
	
	while(file_exists($filename) == true)
	{
		$int++;
		if($int > 100) //Om det finns adam1, adam2, adam3,..., adam00 vill vi inte har fler beställningar! xD
		{
			echo "error";
			$filename= "error";
			break;
		}
		$filename =  "orders/" . $name . $int . ".html"; 
	}

	echo "Filnamn som ska skapas: " . $filename . "<br>";
	

	$myFile = fopen($filename, 'a+');//w indicates you can write text to the file
	$textToWrite = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /></head><body> ";
	$textToWrite .= "<h2>Användare: " . $name . "</h2>";
	$textToWrite .= "<h2>Order: " . $int . "</h2><br>";
	$textToWrite.= "<h2>Utfärdat: " .  date('M d, Y H:i:s', time()) . "</h2>";  
	$textToWrite .= "<h2>Från IP-adress:  " . $ip=$_SERVER['REMOTE_ADDR']; "/h2>";

	 $textToWrite.= " <br><br><table cellpadding='3'>";
	 $textToWrite.= " <br><br><table cellpadding='3'>";
	
	for( $i=0; $i <= $_SESSION['skivor']; $i++)
	{
		if(isset($_SESSION['varukorg'][$i]['productid'])) //Om en produkt är registrerad 
		{
			$textToWrite.= "<tr><td>";
			$textToWrite.=$_SESSION['varukorg'][$i]['productid'];
			$textToWrite.="</td> <td>";
			$textToWrite.= $_SESSION['varukorg'][$i]['price'];
			$textToWrite.= "</td> <td>";
			$textToWrite.= $_SESSION['varukorg'][$i]['qty'];
			$textToWrite.= "</td></tr>";
			
		}
	}
	
	$textToWrite .= "</table></body></html>";

	fwrite($myFile,$textToWrite,strlen($textToWrite));
	fflush($myFile);
	fclose($myFile);
	
	setcookie('UserName','mm',time()-10); //Att sätta en cookie som redan gått ut
	session_unset();
    session_destroy();
    header("Location: login.php");
	 
}
?>

 </div>
 
 


</body>
</html>