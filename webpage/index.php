<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Validating Forms</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>Registration Form</h1>
		<?php

        function validator($pattern)
        {
            return function ($input) use ($pattern) {
                if (preg_match($pattern, $input)) return True;
                else return False;
            };
        }

        $name_validator = validator("#^[a-zA-Z]{2,}$#");
        $email_validator = validator("#^([\w\.-]+)@([\w\.-]+)\.([a-z]{2,5})#$");
        $username_validator = validator("^#[\w]{5,}#$");
        $password_validator = validator("^#([\w]{8,}#$");
        $date_validator = validator("#^(\d{2})\.(\d{2})\.(\d{4})$#");
        $gender_validator = validator("#(Male)|(Female)#i");
        $address_validator = validator("^#[\w-]+#$");
        $city_validator = validator("#^[\w-]+#$");
        $postal_code_validator = validator("#^\d{6}$#");
        $phone_validator = validator("#^(\d{2})\s?(\d{3})\s?(\d{2})\s?(\d{2})$#");
        $credit_card_validator = validator("#^(\d{4})\s?(\d{4})\s?(\d{4})\s?(\d{4})$#");
        $salary_validator = validator("#^UZS \d+$#");
        $url_validator = validator("#^(http|https//:)?(www\.)?([\w-])+\.([a-z]){2,5}$#");

        ?>

		<hr />

		<h2>Please, fill below fields correctly</h2>
        <?php
        $nameErr = $emailErr = $genderErr= $usernameErr = $websiteErr = $passwordErr = $cpasswordErr = $dateofbirthErr = $addressErr =$statusErr =$cityErr = $postalcodeErr = $homephoneErr =$mobileErr= $creditNErr=$creditErr=$salaryErr=$gpaErr = "";
        $name = $email = $gender = $username = $website =  $password = $cpassword = $dateofbirth = $address =$status =$city = $postalcode = $homephone =$mobile= $creditN=$creditE=$salary=$gpa ="";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        } else {
        $name = test_input($_POST["name"]);

        if (!$name_validator($name)) {
        $nameErr = "Only letters and white space allowed";
        }
        }

        if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        }
        }

        if (empty($_POST["website"])) {
        $website = "";
        } else {
        $website = test_input($_POST["website"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (!$url_validator($website)) {
        $websiteErr = "Invalid URL";
        }
        }

        if (empty($_POST["password"])) {
        $password = "Email is required";
        } else {
        $password = test_input($_POST["password"]);
        if (!$password_validator($password)){
            $passwordErr="At least 8 characters";
        }
        }
        if (empty($_POST["cpassword"])) {
                $cpassword = "Email is required";
            } else {
                $cpassword = test_input($_POST["cpassword"]);
                if (!$password_validator($cpasswordErr)){
                    $cpasswordErr="is not same";
                }
            }
        if (empty($_POST["date"])) {
                $dateofbirthErr = "data is required";
            } else {
                $dateofbirth = test_input($_POST["date"]);

                if (!$date_validator($dateofbirth)) {
                    $dateofbirthErr = "";
                }
            }

        if (empty($_POST["status"])){
                $statusErr = "Status is required";
            } else {
                $status = test_input($_POST["status"]);
            }

        if (empty($_POST["address"])){
            $addressErr="Adress is required";
            }
        else{
            $address=test_input($_POST["address"]);
            if (!$address_validator($address)) {
                $addressErr = "This is required field";
            }
        }
            if (empty($_POST["city"])){
                $cityErr="City is required";
            }
            else{
                $city=test_input($_POST["city"]);
                if (!$city_validator($city)) {
                    $cityErr = "This is required field";
                }
            }


            if (empty($_POST["postal code"])){
                $postalcodeErr="Postal code is required";
            }
            else{
                $postalcode=test_input($_POST["city"]);
                if (!$postal_code_validator($postalcode)) {
                    $postalcodeErr = "This is required field";
                }
            }

            if (empty($_POST["hphone"])){
                $homephoneErr="Home phone is required";
            }
            else{
                $homephone=test_input($_POST["hphone"]);
                if (!$phone_validator($homephone)) {
                    $homephoneErr= "This is required field";
                }
            }
            if (empty($_POST["mobile"])){
                $mobileErr="Mobile phone is required";
            }
            else{
                $mobile=test_input($_POST["mobile"]);
                if (!$phone_validator($mobile)) {
                    $mobileErr= "This is required field";
                }
            }

            if (empty($_POST["card number"])){
                $creditNErr="Card number code is required";
            }
            else{
                $creditN=test_input($_POST["card number"]);
                if (!$credit_card_validator($mobile)) {
                    $creditNErr= "This is required field";
                }
            }

            if (empty($_POST["card expiry"])){
                $creditErr="Card number code is required";
            }
            else{
                $creditE=test_input($_POST["credit card"]);
                if (!$credit_card_validator($creditE)) {
                    $creditErr= "This is required field";
                }
            }

            if (empty($_POST["card expiry"])){
                $creditErr="Card Expiry is required";
            }
            else{
                $creditE=test_input($_POST["credit card"]);
                if (!$credit_card_validator($creditE)) {
                    $creditErr= "This is required field";
                }
            }

            if (empty($_POST["salary"])){
                $salaryErr="Input is required";
            }
            else{
                $salary=test_input($_POST["salary"]);
                if (!$salary_validator($salary)) {
                    $salaryErr= "This is required field";
                }
            }







            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
            } else {
                $gender = test_input($_POST["gender"]);
            }
        }

        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        ?>

        <h2>PHP Form Validation Example</h2>
        <p><span class="error">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name: <input type="text" name="name" value="<?php echo $name;?>">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            E-mail: <input type="text" name="email" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            Username: <input type="text" name="username" value="<?php echo $username;?>">
            <span class="error">* <?php echo $usernameErr;?></span>
            <br><br>
            Password <input type="password" name="password" value="<?php echo $password;?>">
            <span class="error">* <?php echo $passwordErr;?></span>
            <br><br>
            Confirm Password <input type="password" name="cpassword" value="<?php echo $cpassword;?>">
            <span class="error">* <?php echo $cpasswordErr;?></span>
            <br><br>
            Date of birth:<input type="date" name="date" value="<?php echo $dateofbirth;?>">
            <span class="error">* <?php echo $dateofbirthErr;?></span>
            <br><br>
            Website: <input type="text" name="website" value="<?php echo $website;?>">
            <span class="error"><?php echo $websiteErr;?></span>
            <br><br>
            Gender:
            <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
            <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
            <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
            <span class="error">* <?php echo $genderErr;?></span>
            <br><br>
            Marital Status:
            <input type="radio" name="status" <?php if (isset($status) && $status=="female") echo "checked";?> value="female">Single
            <input type="radio" name="status" <?php if (isset($status) && $status=="male") echo "checked";?> value="male">Married
            <input type="radio" name="status" <?php if (isset($status) && $status=="other") echo "checked";?> value="other">Divorced
            <input type="radio" name="status" <?php if (isset($status) && $status=="other") echo "checked";?> value="other">Widowed
            <span class="error">* <?php echo $statusErr;?></span>
            <br><br>

            Address:<input type="text" name="address" value="<?php echo $address;?>">
            <span class="error">* <?php echo $addressErr;?></span>
            <br><br>

            City:<input type="text" name="city" value="<?php echo $city;?>">
            <span class="error">* <?php echo $cityErr;?></span>
            <br><br>

            Postal Code:<input type="number" name="postal code" value="<?php echo $postalcode;?>">
            <span class="error">* <?php echo $postalcodeErr;?></span>
            <br><br>

            Home Phone:<input type="number" name="hphone" value="<?php echo $homephone;?>">
            <span class="error">* <?php echo $homephoneErr;?></span>
            <br><br>

            Mobile Phone:<input type="number" name="mobile" value="<?php echo $mobile;?>">
            <span class="error">* <?php echo $mobileErr;?></span>
            <br><br>

            Credit Card Number:<input type="number" name="card number" value="<?php echo $creditN;?>">
            <span class="error">* <?php echo $creditNErr;?></span>
            <br><br>

            Credit Card Expiry Date:<input type="number" name="card expiry" value="<?php echo $creditE;?>">
            <span class="error">* <?php echo $creditErr;?></span>
            <br><br>

            Monthly Salary:<input type="number"  name="salary" placeholder="UZS" value="<?php echo $salary;?>">
            <span class="error">* <?php echo $salaryErr;?></span>
            <br><br>

            Overall GPA:<input type="number" name="gpa" value="<?php echo $gpa;?>">
            <span class="error">* <?php echo $gpaErr;?></span>
            <br><br>

            <input type="submit" name="submit" value="Submit">
        </form>



		<div>
Register
		</div>