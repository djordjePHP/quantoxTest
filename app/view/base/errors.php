
<?php
if(isset($errors)) {
    ?><div class="errors"><?php
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    ?></div><?php
}
?>


