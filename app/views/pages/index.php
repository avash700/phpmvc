<?php require APPROOT.'/views/inc/header.php'; ?>


<h1>
<?php
    echo $data['title'] ;
?>
</h1>
<p>Following rides are posted:</p>


<p><?php print_r($data['rides']); ?></p>



<?php require APPROOT.'/views/inc/footer.php'; ?>