<?
session_start();
$nise=$_SESSION['name'];
if(isset($_SESSION['name'])){
	$text = $_POST['usermsg'];
	
	$fp = fopen("log.html", 'a');
	fwrite($fp, "<div class='msgln'><b>".$_SESSION['name']."</b>: <br>".stripslashes(htmlspecialchars($text))."<br>(".date("g:i A").")<br></div>");
	fclose($fp);
header('location: chat2.php');
}
?>
