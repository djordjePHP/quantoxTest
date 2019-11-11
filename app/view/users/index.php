<?php

include 'app/view/forms/search.php';
?><ul><?php
foreach ($data['users'] as $item => $value) {

    ?>
    <li> <?php echo $value->first_name . ' ' . $value->last_name . ' - email: '. $value->email ?> </li>
    <?php

} ?>
</ul>
