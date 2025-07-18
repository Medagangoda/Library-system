<?php
if(isset($_GET['book_number']))
{
	$book_number=$_GET['book_number'];
?>
<html>
<head>
</head>
<body>
	<form method="POST">
	<fieldset>
	<legend>BOOK DATA</legend>
	<table>
		<tr>
		<td>Book Number:</td>
		<td><input type="number" maxlength="4" name="book_number"></td>
		</tr>
		
		<tr>
		<td>Book Title:</td>
		<td><input type="text" size="30" name="book_title"></td>
		</tr>
		
		<tr>
		<td>Version:</td>
		<td><input type="number"  name="version"></td>
		</tr>
		
		<tr>
		<td>Author:</td>
		<td><input type="text" size="30" name="author"></td>
		</tr>
		
		<tr>
		<td>Availability:</td>
		<td><input type="checkbox" value="Lending" checked name="availability[]"/>Lending
			<input type="checkbox" value="Reference"  name="availability[]"/>Reference
		</td>
		</tr>
		
		<tr>
		<td>Book Type:</td>
		<td>
		<input type="radio" value="ICT" checked name="book_type">ICT 
		<input type="radio" value="None ICT"  name="book_type"> None ICT 
		</td>
		</tr>
		
		<tr><td colspan="2"><input type="submit" value="Submit" name="sub"/></td></tr>
	</table>
	</fieldset>
	</form>
</body>
</html>

<?php
}
?>


<?php
	if(isset($_POST['sub']))
	{
		$book_number=$_POST['book_number'];
		$book_title=$_POST['book_title'];
		$version=$_POST['version'];
		$author=$_POST['author'];
		
		$availability=$_POST['availability'];
		$all_availability="";
		foreach($availability as $available)
			$all_availability=$all_availability." ".$available;
		
		$book_type=$_POST['book_type'];
		
		
		//all commands are printing
		//echo $book_type;
		
		include "connection.php";
		
		$sql_insert="INSERT INTO book VALUES('$book_number','$book_title','$version','$author','$all_availability','$book_type')";
		
		if($result=mysqli_query($con,$sql_insert))
		{
			//echo "Data Successfully submited!";
			header("location:index.php?book_insert='$book_number'");
		}
		else 
		{
			echo "Sorry, data not submitted".mysqli_error($con);
		}
		
	}
?>
