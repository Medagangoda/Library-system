<?php
if(isset($_GET['book_number_edit']))
{
	$book_number=$_GET['book_number_edit'];

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
<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #77aaff 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            padding: 0;
            margin: 0;
            float: right;
            margin-top: 10px;
        }
        header li {
            display: inline;
            padding: 0 20px 0 20px;
        }
        header #branding {
            float: left;
        }
        header #branding h1 {
            margin: 0;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .form-container h2 {
            text-align: center;
            color: #333;
        }
        .form-container table {
            width: 100%;
        }
        .form-container td {
            padding: 10px;
        }
        .form-container input[type='text'], .form-container input[type='number'], .form-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type='submit'] {
            width: auto;
            padding: 10px 20px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container .checkbox-group, .form-container .radio-group {
            margin-top: 10px;
        }
        .back-link {
            display: inline-block;
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #77aaff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">Library</span> System</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h2>BOOK DATA</h2>
            <form method="POST">
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
                        <td class="checkbox-group">
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
                        <td class="radio-group">
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

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Submit" name="sub"/>
                            <a href="index.php" class="back-link">Back to page</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
<?php
		}
	}
	else
	{
		echo "Error occured..";
	}
}

if(isset($_POST['sub']))
{
    $book_title=$_POST['book_title'];
    $version=$_POST['version'];
    $author=$_POST['author'];

    $availability=$_POST['availability'];
    $all_availability="";
    foreach($availability as $available)
        $all_availability=$all_availability." ".$available;

    $book_type=$_POST['book_type'];

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
