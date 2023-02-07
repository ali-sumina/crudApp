<?php
    require_once "config.php";

$id = $_GET['ID'];

if(isset($id) && !empty(trim(($id)))){
    $sql = "SELECT * FROM travelplan WHERE ID = ?";

    if($stmt = mysqli_stmt_prepare($conn, $sql)) {

        $param_id = $id;

        mysqli_stmt_bind_param($stmt, 'i', $param_id);

        //execute. if success, fetch the data

        if(mysqli_stmt_execute($stmt)) {
            //assign the result from statement
            $result = mysqli_stmt_get_result($stmt);

            //we check whether the requested ID is unique
            if(mysqli_num_rows($result) == 1){
                //acc to the ID we fetch another data (as associative array) we have (city. country. year)
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                //break down the data from array into vars
                $city = $row['City'];
                $country = $row['Country'];
                $year = $row['Year'];

            } else{
                echo "Something went wrong";

                //why do we exit here?

                exit();
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style>
        body{
            margin-top: 70px;
        }
    </style>

</head>
<body>
<div class="container">
    <h2>My Travel Plan</h2>
    <a href="create.php" class="btn btn-primary">Create a plan</a>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">City</th>
      <th scope="col">Country</th>
      <th scope="col">Year</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><?php echo $city ?></td>
      <td><?php echo $country ?></td>
      <td><?php echo $year ?></td>
    </tr>
  </tbody>
</table>
</div>
</body>
</html>