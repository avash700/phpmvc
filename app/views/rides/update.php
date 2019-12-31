<form action="<?php echo URLROOT; ?>rides/update/<?php echo $data['rideid'];?>" method="POST">

<label for="rideid"> ride id: </label>
    <input type="text" name="rideid" value="<?php echo $data['rideid']; ?>" readonly> 
     
    <br>

<label for="source"> source: </label> 
    <input type="text" name="source" value="<?php echo $data['source']; ?>"> 
    <span> <?php echo $data['source_err']; ?> </span> 
    <br>
    
    <label for="destination"> destination: </label>
    <input type="text" name="destination" value="<?php echo $data['destination']; ?>"> 
    <span><?php echo $data['destination_err']; ?></span> 
    <br>
    
    <label for="departure"> departure: </label> 
    <input type="datetime-local" name="departure" value="<?php echo $data['departure']; ?>"> 
    <span><?php echo $data['departure_err']; ?></span> 
    <br>
    
    <label for="vehicle"> vehicle: </label> 
    <input type="text" name="vehicle" value="<?php echo $data['vehicle']; ?>"> 
    <span><?php echo $data['vehicle_err']; ?></span> 
    <br>
    
    <label for="seats"> seats: </label> 
    <input type="number" name="seats" value="<?php echo $data['seats']; ?>"> 
    <span><?php echo $data['seats_err']; ?></span>
    <br>
    
   <input type="submit" value="Update Ride">
</form>