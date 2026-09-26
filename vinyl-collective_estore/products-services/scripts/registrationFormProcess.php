<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//registrationFormProcess.php
if (isset($_POST['gender']) && ($_POST['gender'] == "Female"))
    $gender = "F";
else if (isset($_POST['gender']) && ($_POST['gender'] == "Male"))
    $gender = "M";
else $gender = "O";

if (emailAlreadyExists($db, $_POST['email']))
{
    echo "<h3>Sorry, but your e-mail address is already registered.</h3>";
}
else
{
    $unique_login = getUniqueID($db, $_POST['loginName']);
    if ($unique_login != $_POST['loginName'])
    {
        echo "<h3>Your preferred login name already exists.<br>So ...
              we have assigned $unique_login as your login name.</h3>";
    }

    $query = "INSERT INTO Customers(
        customer_id,
        salutation,
        customer_first_name, customer_middle_initial, customer_last_name,
        gender,
        email_address,
        login_name, login_password,
        phone_number,
        address, town_city, county, country
    )
    VALUES (
        NULL,
        '$_POST[salute]',
        '$_POST[firstName]', '$_POST[middleInitial]', '$_POST[lastName]',
        '$gender',
        '$_POST[email]',
        '$unique_login', '$_POST[loginPassword]',
        '$_POST[phone]',
        '$_POST[address]', '$_POST[city]', '$_POST[state]', '$_POST[country]'
    );";
    $success = mysqli_query($db, $query);
    echo "<h3>Thank you for registering with Hannah Kat's Vinyl Collective!</h3>";
    echo "<h3>To log in and start shopping please
         <a href='/products-services/loginForm.php'>click here</a>.</h3>";
}
mysqli_close($db);

function emailAlreadyExists($db, $email)
{
    $query = "SELECT * FROM Customers WHERE email_address = '$email'";
    $customers = mysqli_query($db, $query);
    $numRecords = mysqli_num_rows($customers);
    return ($numRecords > 0) ? true : false;
}

function getUniqueID($db, $loginName)
{
    $unique_login = $loginName;
    $query = "SELECT * FROM Customers WHERE login_name = '$unique_login'";
    $customers = mysqli_query($db, $query);
    $numRecords = mysqli_num_rows($customers);
    if ($numRecords != 0)
    {
        $i = -1;
        do
        {
            $i++;
            $unique_login = $loginName.$i;
            $query = "SELECT * FROM Customers WHERE login_name = '$unique_login'";
            $customers = mysqli_query($db, $query);
            $numRecords = mysqli_num_rows($customers);
        }
        while ($numRecords != 0);
    }
    return $unique_login;
}
?>