<!DOCTYPE html>
<html>
<head>
    <title>Library System</title>
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
        .search-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .search-container input[type='text'], .search-container select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-container input[type='submit'] {
            padding: 10px 20px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-container a {
            float: right;
            padding: 10px 20px;
            border: none;
            background-color: #77aaff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-links a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 5px;
        }
        .edit-link {
            background-color: #77aaff;
            color: white;
        }
        .delete-link {
            background-color: #ff4444;
            color: white;
        }
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
                    <li class="current"><a href="index.php">Home</a></li>
                    <li><a href="book_number.php">Add New Book</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="search-container">
            <form action="" method="POST">
                <input type="text" size="30" name="keyword" placeholder="Search..."/>
                <select name="search_type">
                    <option value="book_title">Book Title</option>
                    <option value="author">Author</option>
                    <option value="availability">Availability</option>
                </select>
                <input type="submit" value="Search" name="sub"/>
                <a href="book_number.php">Add New</a>
            </form>
        </div>

        <?php
            if((isset($_GET['book_insert'])==true))
            {
                echo "<div class='message success'><p>A record for new book is successfully submitted!</p></div>";
            }
            elseif((isset($_GET['book_edit'])==true))
            {
                echo "<div class='message success'><p>A record for new book is successfully editted!</p></div>";
            }
        ?>

        <?php
            if(isset($_POST['sub']))
            {
                $keyword=$_POST['keyword'];
                $search_type=$_POST['search_type'];

                include "connection.php";

                if($keyword=="")
                    $sql_select = "SELECT * FROM book";

                else
                    $sql_select = "SELECT * FROM book WHERE $search_type LIKE '%$keyword%'";

                $result=mysqli_query($con,$sql_select);

                ?>
                <table>
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
                    <td class="action-links">
                        <a href="book_edit.php?book_number_edit=<?php echo $book_number; ?>" class="edit-link">Edit</a>
                        <a href="index.php?book_number_delete=<?php echo $book_number; ?>" class="delete-link"
                        onclick="return confirm('Are you sure?');">Delete</a>
                    </td></tr>

                    <?php
                }
                ?>
                </table>
                <?php
            }

            elseif((isset($_GET['book_number_delete'])==true) && (isset($_GET['book_number_delete'])<>null))
            {
                $book_number=$_GET['book_number_delete'];

                include "connection.php";
                $sql_delete="Delete FROM book WHERE book_number='$book_number'";
                $result=mysqli_query($con,$sql_delete);
                if($result)
                    echo "<div class='message success'>The book data deleted...</div>";
                else
                    echo "<div class='message error'>Data is not deleted...".mysqli_error($con)."</div>";
            }
        ?>
    </div>
</body>
</html>
