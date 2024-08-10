<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark">
    <h1 class="text-info text-center p-3">Voting System</h1>
    <div class="bg-info py-4">
        <h2 class="text-center">Register Account</h2>
        <div class="container text-center">
            <form action="../actions/send_mail.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" class="form-control w-50 m-auto" name="fullname" placeholder="Enter your fullname" require="required">
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control w-50 m-auto" name="mobile" placeholder="Enter your mobile number" require="required">
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control w-50 m-auto" name="email" placeholder="Enter your email" require="required">
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control w-50 m-auto" name="password" placeholder="Enter your password" require="required">
                </div>

                <!-- <div class="mb-3">
                    <input type="text" class="form-control w-50 m-auto" name="cpassword" placeholder="Confirm password" require="required">
                </div> -->

                <div class="mb-3">
                    <input type="file" class="form-control w-50 m-auto" name="photo">
                </div>

                <div class="mb-3">
                    <select name="std" class="form-select w-50 m-auto">
                        <option value="group">Group</option>
                        <option value="voter">Voter</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn btn-dark my-4">Register</button>
                <!-- <div class="text-cente">
                    //<?php
                    //echo $msg;
                    //?>
                </div> -->
                <p>Already have an account? <a href="../" class="text-white">Login here</a></p>
            </form>
        </div>
    </div>
    
</body>
</html>
