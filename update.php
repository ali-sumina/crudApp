<?php
require_once "config.php";

$city = $country = $year = "";
$city_err = $country_err = $year_err = "";
$id = $_GET['id'];

if(isset($id) && !empty($id)){
    //if id exists

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate City

    //delete spaces
    $input_city = trim($_POST["city"]);
    //check whether it's empty
    if (empty($input_city)){
        $city_err = "Please enter the city you plan to travel to";
    } //check whether it's string
    elseif ((!filter_var($input_city, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/"))))){

        //how to offer a dropdown with available cities?

        $city_err = "Please enter a valid city";
    } //define that input value equals what we will insert into db
    else {
        $input_city = $city;
    }

    //Validate Country
    $input_country = trim($_POST['country']);
    if (empty($input_country)){

        //if we choose the city, how to automatically fill the country this city is located in?

        $country_err = "Please enter the country your city belongs to";
    } //check whether it's string
    elseif ((!filter_var($input_country, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/"))))){
        $country_err = "Please enter a valid city";
    } //define that input value equals what we will insert into db
    else {
        $input_country = $country;
    }

    //Validate Year
    $input_year = trim($_POST['year']);
    if (empty($input_year)){
        $year_err = "Please enter the year";
    } //check whether it's string
    elseif (!ctype_digit($input_year)){
        $year_err = "Please enter a valid year";
    } //define that input value equals what we will insert into db
    else {
        $input_year = $city;
    }

    //check whether errors are empty to continue
    if (empty($city_err) && empty($country_err) && empty($year_err)){
        //set the statement -- prepare it for next vars
        $sql = "UPDATE travelplan SET city = ?, country = ?, year = ? WHERE id = ?";

        //set parameters
        $param_city = $city;
        $param_country = $country;
        $param_year = $year;
        $param_id = $id;

        //check the connection with db and bind parameters with statement
        if ($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ssii", $param_city, $param_country, $param_year, $param_id);


            //execute the statement
            if(mysqli_stmt_execute($stmt)){
                //redirect to main page
                header("location: success.php");
                //finish the program
                exit();
            } else {
                echo "Something went wrong";
            }
        }
        //close statement
        mysqli_stmt_close($stmt);
    }
    //close connection
    mysqli_close($conn);
}
} else {
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
                    $city = $row['city'];
                    $country = $row['country'];
                    $year = $row['year'];
    
                } else{
                    echo "Something went wrong";
    
                    //why do we exit here?
    
                    exit();
                }
    
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        } else{
            echo "Something went wrong";
    
                    exit();
                }
    
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        body{
            margin-top: 70px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Set your destination</h2>
    <form action="<?php 
    //still not clear what it means???
    echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
    method="post">
    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">City</label>
    <!-- We create "value" attribute for the valid feedback -->

    <!-- Check whether city_err is empty, and if not, we include the class "invalid-feeback" (span below) to display the error -->

    <input name="city" type="city" class="form-control <?php (!empty($city_err)) ? 'is-invalid' : " " ?>" id="exampleFormControlInput1" placeholder="Type the city" value="<?php echo $city ?>">
    <!-- Create a span for the errors -->
    <span class="invalid-feedback"><?php echo $city_err; ?></span>
    </div>

    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Country</label>
    <input name="country" type="city" class="form-control <?php (!empty($country_err)) ? 'is-invalid' : " " ?>" id="exampleFormControlInput1" placeholder="Type the country" value="<?php echo $country ?>">
    <span class="invalid-feedback"><?php echo $country_err; ?></span>
    </div>

    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Year</label>
    <input name="year" type="city" class="form-control <?php (!empty($year_err)) ? 'is-invalid' : " " ?>" id="exampleFormControlInput1" placeholder="Type the year" value="<?php echo $year ?>">
    <span class="invalid-feedback"><?php echo $year_err; ?></span>
    </div>

    <!-- show id, either submit the form with data or cancel and get back to the home page -->
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" class="btn btn-primary" value="Submit">
    <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>

    </form>


</div>
    
</body>
</html>