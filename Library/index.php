<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form action="" method="POST">
		<fieldset>
			<legend>Search Book</legend>
			<table>
				<tr>
				<td><input type="text" size="30" name="keyword"/></td>
				<td><select name="search_type">
					<option value="book_title">Book Title</option>
					<option value="author">Author</option>
					<option value="availability">Availability</option>
					</select>
					
					<input type="submit" value="Search" name="sub"/>
					<a href="book_number.php">Add New</a>
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
<body>
</html>


<?php
	if(isset($_POST['sub']))
	{
		$keyword=$_POST['keyword'];
		$search_type=$_POST['search_type'];
		
		//echo $keyword.$search_type;
		
		include "connection.php";
		
		if($keyword=="")
			$sql_select = "SELECT * FROM book";
	
		else
			$sql_select = "SELECT * FROM book WHERE $search_type LIKE '%$keyword%'";
		
		$result=mysqli_query($con,$sql_select);
			
		?>
		<table border="1">
		<caption>Book Details</caption>
		<tr>
			<th>Book Num</th>
			<th>Title</th>
			<th>Author</th>
			<th>Action</th>
		</tr>
		<?php
		
		while($row=mysqli_fetch_assoc($result))
		{	
			echo "<tr><td>".$row['book_number']."</td><td>".
			$row['book_title']."</td><td>".$row['author']."</td>";
			
			$book_number=$row['book_number'];
			?>
			<td><a href="book_edit.php?book_number_edit=<?php echo $book_number; ?>">Edit</a>
			<a href="index.php?book_number_delete=<?php echo $book_number; ?>" 
			onclick="return confirm('Are you sure?');">Delete</a></td></tr>
			
			<?php
		}
		?>
		</table>
		<?php
		
	}
	
	elseif((isset($_GET['book_number_delete'])==true) && (isset($_GET['book_number_delete'])<>null))
	{
		$book_number=$_GET['book_number_delete'];
		//echo $book_number;
		
		include "connection.php";
		$sql_delete="Delete FROM book WHERE book_number='$book_number'";
		$result=mysqli_query($con,$sql_delete);
		if($result)
			echo "The book dta deleted...";
		else
			echo "Data is not deleted...".mysqli_error($con);
	}
	
	elseif((isset($_GET['book_insert'])==true))
	{
		echo "<br/><p>A record for new book is successfully submitted!</p>";
	}
	elseif((isset($_GET['book_edit'])==true))
	{
		echo "<br/><p>A record for new book is successfully editted!</p>";
	}
	
?>