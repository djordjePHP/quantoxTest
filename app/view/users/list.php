<?php
if(isset($users)){ ?>
<div class="listOfUsers">
    <h1>Lista korisnika:</h1>
    <ol><?php
            foreach ($users as $item => $value) {

                ?>
                <li> <?php echo $value->first_name . ' ' . $value->last_name . ' - email: '. $value->email ?> </li>
                <?php

            } ?>
    </ol>
</div>
<?php
}

