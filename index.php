<!DOCTYPE html>
<html>
<head>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />

<title>Elvis, A Virtual Web Browser TV Room</title>
<link rel="stylesheet" href="css/elvis.css">
<!--[if gt IE 8]>
	<link rel="stylesheet" type="text/css" href="css/ie-transform.css" />
<![endif]-->
<!--[if  IE 8]>
	<link rel="stylesheet" type="text/css" href="css/ie8.css" />
<![endif]-->
<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="css/ie-zoom.css" />
<![endif]-->
</head>
<body>
<?php 
$desired_set = '';
 if (isset($_GET["list"])) {  // this is after the form is filled out
 	$desired_set = $_GET["list"];
 } 
 ?>

<h1>Elvis is watching <?php echo ($desired_set ==
	''? "" : " ". " " . $desired_set)?> </h1>

<?php
if ($desired_set ==	'') { 
	echo '
		<div id="wrapper">
<p> Select the list from which you would like to see websites. </p>
<p> You can add a list at /lists (and add them as options in this form select).</p>
	<form action="index.php" method="get" name="form1">
	<select name="list" style="height:30px; width:350px;">
	<option value="news">News</option>
	<option value="code stuff">Code Stuff</option>
	</select><br/>
	<input name="submit" type="submit" style= "height:30px; width:175px;"/>
	</form>
	</div>';
} 

else {
	?>
	<p> This is a resource intensive process and the page may take a while to load if you have a lot of sites.  Want to see a different group?  Click <a href ="index.php">here</a> to make a different choice.</p>
	<?php
	$set_file = "lists/" . $desired_set . ".txt";
	echo ("<p> Is there a site that should be included on this list, but is missing?  Add it to " . $set_file . "</p>");
	$file=fopen($set_file,"r");
	while(($url = fgets($file)) !== false){
$block =  <<<HEREDOC
<div class="thumbnail"> 
<a href="{$url}"> {$url} </a>
<iframe src="{$url}"></iframe>
</div> 
HEREDOC;
echo $block;
	 }
	fclose($file);
}
?>

</body>
</html>
