<?php

session_start();

include("php/config.php");
if(!isset($_SESSION['valid'])){
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Home</a></p>
        </div>
        <div class="right-link">
            <a href="#">Change Profile</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php

            if(isset($_POST['submit'])){
                $username=$_POST['username'];
                $email=$_POST['email'];
                $age=$_POST['age'];

                $id=$_SESSION['id'];

                $edit_query=mysqli_query($con,"UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE Id=$id ") or die("Error occured");

                if($edit_query){
                    echo "<div class='pass_message'>
                            <p>Profile Updated Successfully!</p>
                          </div><br>";
                    echo "<a href='Home.php'><button class='btn'>Go Home</button></a>";
                }

            }
            else{

                $id=$_SESSION['id'];
                $query=mysqli_query($con,"SELECT * FROM users WHERE Id=$id");


                while($result= mysqli_fetch_assoc($query)){
                    $res_Uname=$result['Username'];                    
                    $res_Email=$result['Email'];                    
                    $res_Age=$result['Age'];                    

                }

            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?php echo $res_Uname; ?>" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" autocomplete="off" value="<?php echo $res_Age; ?>" id="age" required>
                </div>
                <div class="field">
                    <input type="Submit" class="btn" name="submit" value="Update" required>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>