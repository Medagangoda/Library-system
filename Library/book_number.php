<html>
<head></head>
<body>
	<form method="POST" action="">
		<fieldset>
		<legend>Add New Book</legend>
		<table>
		<tr><td>Book Number:<input type="number" size="4" name="book_number"/></td>
			<td><input type="submit" value="Add..." name="sub"/>
			<a href="index.php">Back to List</a></td>
		</table>
		</fieldset>
	</form>
</body>
</html>

<?php
	if(isset($_POST['sub']))
	{
		$book_number=$_POST['book_number'];
		include "connection.php";
		
		$sql_select="SELECT * FROM book WHERE book_number='$book_number'";
		$result=mysqli_query($con,$sql_select);
		
		if(mysqli_num_rows($result)>0)
		{
			echo "<br/><p>The book data is already available!</p>";
		}
		elseif (!($book_number==null))
		{
			header("location:book_new.php?book_number=".$book_number);
		}
		else
		{
			echo "The book data  is not availabe in the database";
		}
	}
?>