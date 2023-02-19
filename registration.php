<!DOCTYPE html>
<html>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<body>
<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gymproject';

$firstNameErr = "";
$lastNameErr = "";
$contactNumberErr = "";
$emailErr = "";
$emailConfirmErr = "";
$addressErr = "";
$passwordErr = "";
$confirmPasswordErr = "";
$postCodeErr = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $contactNumber = $_POST["contactnumber"];
    $emailAddress = $_POST["emailaddress"];
    $emailConfirm = $_POST["emailconfirm"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];
    $postCode = $_POST["postcode"]; 

    $errMsg = "";

    if(isset($_POST['create'])){
        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

        //check connection
        if (!$con){
            die('Could not connect: ' . mysql_error());
        } 


        if($firstName == ""){
            $firstNameErr = "First name required";
        }

        if($lastName == ""){
            $lastNameErr = "Last name required";
        }

        if($contactNumber == ""){
            $contactNumberErr = "Contact required";
        }

        if($emailAddress == ""){
            $emailErr = "Email Address required";
        }

        if($emailConfirm == ""){
            $emailConfirmErr = "Email  required";
        }
        
        if($emailAddress != $emailConfirm){
            $emailConfirmErr = "Email does not match";
        }

        if($postCode == ""){
            $postCodeErr = "Post Code required";
        }

        if($address == ""){
            $addressErr = "Address required";
        }

        if($password == ""){
            $passwordErr = "Password required";
        }

        if($confirmPassword == ""){
            $confirmPasswordErr = "Required";
        }
        if($password != $confirmPassword)
        {
            $confirmPasswordErr = "Password does not match";
        }
        $sqlChecker = "SELECT id FROM users WHERE email='$emailAddress'";
        $resultChecker = $con->query($sqlChecker);

        if ($resultChecker->num_rows > 0)  {
            $errMsg = "User already Exists!";
        } 
          else {
            $sql = "INSERT INTO users (firstname, lastname, email, postcode, address,password ) VALUES('$firstName', '$lastName', '$emailAddress', '$postCode', '$address', '$password')";
            if ($con->query($sql) === TRUE) {
                header("Location: login.php");
            } else {
                $errMsg = "Error!";
            }
          }

         // Close connection
        mysqli_close($con);
        
    }
    
}

?>
<form class="form" method="post" name="registration">
    <span class="error"> *  <?php echo $errMsg;?> </span>  
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="firstname">
            <span class="error"> *  <?php echo $firstNameErr;?> </span>  
            <br> <br>  
        </div>
    </div>
    <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="lastname">
                <span class="error"> *  <?php echo $lastNameErr;?> </span>  
                <br> <br>  
            </div>
    </div>
    <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Contact number</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="contactnumber">
                <span class="error"> *  <?php echo $contactNumberErr;?> </span>  
                <br> <br>  
            </div>
    </div>
    <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email address</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="emailaddress">
                <span class="error"> *  <?php echo $emailErr;?> </span>  
                <br> <br>  
            </div>
    </div>
    <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Confirm email address</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="emailconfirm">
                <span class="error"> *  <?php echo $emailConfirmErr;?> </span>  
                <br> <br>  
            </div>
    </div>
    <div class="mb-3 row">
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Post code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="postcode">
                    <span class="error"> *  <?php echo $postCodeErr;?> </span>  
                    <br> <br>  
                </div>
        </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Address </label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="address" rows="3"></textarea>
                    <span class="error"> *  <?php echo $addressErr;?> </span>  
                    <br> <br>  
                </div>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
        <input type="password" class="form-control" name="password">
        <span class="error"> *  <?php echo $passwordErr;?> </span>  
        <br> <br>  
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-10">
        <input type="password" class="form-control" name="confirmpassword">
        <span class="error"> *  <?php echo $confirmPasswordErr;?> </span>  
        <br> <br>  
        </div>
    </div>
    <input type="submit" class="btn btn-primary mb-3" name="create" value ="Register">

</form>

</body>
</html>