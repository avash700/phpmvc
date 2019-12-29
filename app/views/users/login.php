<?php require APPROOT.'/views/inc/header.php'; ?>

<h1> <?php echo "login "; ?> </h1>

<form action="<?php echo URLROOT; ?>users/login" method="POST">
   
   
    <label for="name"> Email :</label>
    <input type="email" name="email" value="<?php echo $data['email']; ?>"> 
    //yaha lyang huna sakxa 
    <span> <?php echo $data['email_err'] ; ?></span>
    <br>

    <label for="password"> Password :</label>
    <input type="password" name="password" value="<?php echo $data['password']; ?>"> 
    //yaha lyang huna sakxa 
    <span> <?php echo $data['password_err'] ; ?></span>
    <br>


    <input type="submit" value="Login"> <br>

    <a href="<?php echo URLROOT; ?>users/register"> Don't have an account? </a> 





</form>

<?php require APPROOT.'/views/inc/footer.php'; ?>