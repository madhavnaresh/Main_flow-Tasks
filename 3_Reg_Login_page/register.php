<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="box form-box">

            <?php
            include("php/config.php");
            if(isset($_POST['submit'])){
                $username=$_POST['username'];
                $email=$_POST['email'];
                $age=$_POST['age'];
                $password=$_POST['password'];


                //verifying unique emil

                $verify_query= mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

                if (mysqli_num_rows($verify_query)!=0 ){
                    echo "<div class='fail_message'>
                            <p>This email is already used, try another one</p>
                          </div><br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                }
                else{

                    mysqli_query($con,"INSERT INTO users(Username,Email,Age,Password) VALUES ('$username','$email','$age','$password')") or die ("Error occured");
                    echo "<div class='pass_message'>
                            <p>Registered Successfully!</p>
                          </div><br>";
                    echo "<a href='index.php'><button class='btn'>Login now</button></a>";
                }


            }
            else{
            ?>


            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" autocomplete="off" id="age" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="Submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>

</html>