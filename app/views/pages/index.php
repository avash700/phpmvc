<?php require APPROOT . '/views/inc/header.php'; ?>


<h1>
    <?php
    echo $data['title'];
    ?>
</h1>
<p>Following rides are posted:</p>




<?php foreach ($data['rides'] as $ride) : ?>
    <div>
        <label for=""> Source: <?php echo $ride->source; ?>  </label> <br>
        <label for=""> Destination: <?php echo $ride->destination; ?>  </label> <br>
        <label for=""> Departure: <?php echo $ride->departure; ?>  </label> <br>
        <label for=""> Vehicle: <?php echo $ride->vehicle; ?>  </label> <br>
        <label for=""> Seats Available: <?php echo $ride->seats; ?>   </label> <br>
        <label for=""> Posted By: <?php echo $ride->full_name; ?>   </label> <br>
    </div>
    <hr>
<?php endforeach; ?>



<?php require APPROOT . '/views/inc/footer.php'; ?>