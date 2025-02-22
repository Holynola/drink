<?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    }
?>

<script>
    var message = "<?php echo $msg ?>";

    if (message != '') {
        alert(message);
    }
</script>