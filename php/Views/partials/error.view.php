<div class="errors-container">
    <?php
    if(isset($_SESSION['error'])){
        foreach ($_SESSION['error'] as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
    $_SESSION['error'] = [];
    ?>
</div>