<?php require APPROOT.'/views/inc/header.php'; ?>

<h1> <?php echo "create an account"; ?> </h1>

<form action="<?php echo URLROOT; ?>users/register" method="POST">
   
    <label for="name"> Full Name :</label>
    <input type="text" name="name" value="<?php echo $data['name']; ?>">
   <!-- //yaha lyang huna sakxa  -->
    <span> <?php echo $data['name_err'] ; ?></span>
    <br>

    <label for="name"> Email :</label>
    <input type="email" name="email" value="<?php echo $data['email']; ?>"> 
    <!-- //yaha lyang huna sakxa  -->
    <span> <?php echo $data['email_err'] ; ?></span>
    <br>

    <label for="password"> Password :</label>
    <input type="password" name="password" value="<?php echo $data['password']; ?>"> 
    <!-- //yaha lyang huna sakxa  -->
    <span> <?php echo $data['password_err'] ; ?></span>
    <br>

    <label for="confirm_pasword"> Confirm Password :</label>
    <input type="password" name="confirm_password" value="<?php echo $data['confirm_password']; ?>"> 
    <!-- //yaha lyang huna sakxa  -->
    <span> <?php echo $data['confirm_password_err'] ; ?></span>
    <br>

    <input type="submit" value="Register"> <br>

    <a href="<?php echo URLROOT; ?>users/login"> Have an account? </a> 





</form>

<?php require APPROOT.'/views/inc/footer.php'; ?>