<?php
    if(isset($_SESSION['errors'])){
        ?>
        <div class="errors-container">
        <?php
        foreach ($_SESSION['errors'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo "</div>";
    }
    unset($_SESSION['errors']);
?>


    
