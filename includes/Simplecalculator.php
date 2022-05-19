<?php
#Visit https://t4tutorials.com for more tutorials
if(isset($_POST['sub'])){
	$num1=$_POST['n1'];
	$num2=$_POST['n2'];
	$oprnd=$_POST['sub'];
	if($oprnd=="+")
		$ans=$num1+$num2;
	else if($oprnd=="-")
		$ans=$num1-$num2;
	else if($oprnd=="x")
		$ans=$num1*$num2;
	else if($oprnd=="/")
		$ans=$num1/$num2;
}?>
<html>
<head>
	<style type="text/css">
		.containerAt
		{
			left: 0%;
			margin-Top: 100px;
			text-align: left;
			/* border: 1px solid green; */
			
		}
		.containerAt input, .containerAt select {
  			width: 100%;
  			padding: 12px 20px;
  			margin: 8px 0;
  			display: inline-block;
  			border: 1px solid #ccc;
  			border-radius: 4px;
  			box-sizing: border-box;
		}

		.containerAt input[type=submit] {
  			width: 5%;
 		 	background-color: #4CAF50;
  			color: white;
  			padding: 14px 20px;
  			margin: 8px 0;
  			border: none;
	 	 	border-radius: 4px;
  			cursor: pointer;
}
	</style>
</head>
<body>
<!–– Visit https://t4tutorials.com for more tutorials -->
<div class="containerAt">
<form method="post" action="">
<br>
First Number:<input name="n1" value="">
<br>
Second Number:<input name="n2" value="">
<br>
<input type="submit" name="sub" value="+">
<input type="submit" name="sub" value="-">
<input type="submit" name="sub" value="x">
<input type="submit" name="sub" value="/">
<br>
<br>Result: <input type='text' value="<?php echo $ans; ?>"><br>
</form>
	</div>
</body>
</html>