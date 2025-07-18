<?php
if(isset($_GET['book_number_edit']))
{
	$book_number=$_GET['book_number_edit'];
	//echo $book_number_edit;
	
	include "connection.php";
	$sql_select="SELECT * FROM book WHERE book_number='$book_number'";
	$result=mysqli_query($con, $sql_select);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
			$book_number=$row['book_number'];
			$book_title=$row['book_title'];
			$author=$row['author'];
			$version=$row['version'];
			$availability=$row['availability'];
			$book_type=$row['book_type'];
	
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
		<td><input type="number" maxlength="4" name="book_number" value="<?php echo $book_number;?>"/></td>
		</tr>
		
		<tr>
		<td>Book Title:</td>
		<td><input type="text" size="30" name="book_title" value="<?php echo $book_title;?>"/></td>
		</tr>
		
		<tr>
		<td>Version:</td>
		<td><input type="number"  name="version" value="<?php echo $version;?>"/></td>
		</tr>
		
		<tr>
		<td>Author:</td>
		<td><input type="text" size="30" name="author" value="<?php echo $author;?>"/></td>
		</tr>
		
		<tr>
		<td>Availability:</td>
		<td>
		<input type="checkbox" value="Lending"  
		<?php
			if(strpos($availability, 'Lending'))
			{
				echo "checked";
			}
		?>
		name="availability[]"/>Lending
		
		
		<input type="checkbox" value="Reference" 
			<?php
			if(strpos($availability, 'Reference'))
			{
				echo "checked";
			}
			?>
		name="availability[]"/>Reference
		</td>
		</tr>
		
		<tr>
		<td>Book Type:</td>
		<td>
		<input type="radio" value="ICT" 
		<?php
			if($book_type=='ICT')
			{
				echo "checked";
			}
		?>
		name="book_type">ICT 
		
		
		<input type="radio" value="None ICT" 
		<?php
			if($book_type=='None ICT')
			{
				echo "checked";
			}
		?>
		name="book_type"> None ICT 
		</td>
		</tr>
		
		<tr><td colspan="2"><input type="submit" value="Submit" name="sub"/>&nbsp;&nbsp;<a href="index.php">Bach to page</a></td></tr>
	</table>
	</fieldset>
	</form>
</body>
</html>

<?php
		} // end of if
		
	} //end of while
	else
	{
		echo "Error occured..";
	}
?>

<?php
}
?>


<?php
	if(isset($_POST['sub']))
	{
		//$book_number=$_POST['book_number'];
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
		
		$sql_update="UPDATE book SET book_title='$book_title',version='$version',author='$author',availability='$all_availability',book_type='$book_type'
		WHERE book_number='$book_number'";
		
		if($result=mysqli_query($con,$sql_update))
		{
			header("location:index.php?book_edit='$book_number'");
		}
		else 
		{
			echo "Sorry, data not updated".mysqli_error($con);
			mysqli_close($con);
		}
		
	}
?>
