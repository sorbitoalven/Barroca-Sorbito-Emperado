<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_db";

$connection = new mysqli($servername, $username, $password, $database);


$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
   
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if ( empty($name) || empty($email) || empty($phone) || empty($address) ) {
            $errorMessage = "All the fields are require";
            break;
        }

        $sql = "INSERT INTO students (name, email, phone, address)" .
                "VALUES ( '$name', '$email', '$phone','$address')";
                $result= $connection->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Clients added correctly";

        header("location: /dbphp/home.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>students list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?fbclid=IwAR0XUJU03vLwqBWQlVsu_CCvCGRM8o4AGe7hlceBayAsyFi9IRYyh90EceY">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?fbclid=IwAR1PIDcXY_SBcBFGU4HXKhUFsH6ppDm_EdIT7IfebkczwzPd9sB-qam_87s"></script>
</head>
<body>
   <div class="container my-5">
    <h2>New Student</h2>

    <?php
    if ( !empty($errorMessage) ) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>
    <form method="post">
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $name; ?>">
            </div>
        </div>
        <?php
        if ( !empty($successMessage) ) {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                 <div class='alert alert-success alert-dismissible fade show' role='alert'>
                     <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
             </div>
            </div>
            ";
        }
        ?>
       
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
               <a class="btn btn-outline-primary" href="/dbphp/home.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
   </div>
</body>
</html>