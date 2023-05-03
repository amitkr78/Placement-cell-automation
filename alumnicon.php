<!DOCTYPE html>
<html>
<head>
    <title>Alumni Connect</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
	
   
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }
        form {
            margin: 0 auto;
            width: 50%;
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease-in-out;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 50%;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
            color: #333;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .message {
            margin-top: 30px;
            text-align: center;
        }
        .message p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
   <h1>Alumni Connect</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form method="post" action="" class="bg-white rounded-lg shadow-lg p-4">
                <div class="form-group">
                    <label for="jobRole" class="font-weight-bold">Job Role:</label>
                    <input type="text" name="jobRole" id="jobRole" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="company" class="font-weight-bold">Company:</label>
                    <input type="text" name="company" id="company" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>




    <?php
    if (isset($_POST['submit'])) {
        $jobRole = $_POST['jobRole'];
        $company = $_POST['company'];
        $rows = array();

        if (($handle = fopen("alumni.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($data[1] == $jobRole && $data[2] == $company) {
                    $rows[] = $data;
                }
            }
            fclose($handle);
        }

       if (count($rows) > 0) {
    echo "<h2 style='text-align: center;'>Results for $jobRole at $company:</h2>";
    echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Phone Number</th></tr>";
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[3] . "</td>";
                echo "<td>" . $row[4] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>No results found for $jobRole at $company</h2>";
        }
    }
    ?>

</body>
</html>
