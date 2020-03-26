

<?
session_start();
if(isset($_POST['submitmsg'])){
	$text = $_POST['usermsg'];
	$fp = fopen("log.html", 'a');
	fwrite($fp, "<div class='msgln'><b>".$_SESSION['name']."</b>: <br>".stripslashes(htmlspecialchars($text))."<br>(".date("g:i A").")<br></div>");
	fclose($fp);
header('location: chat2.php');
}
?>
