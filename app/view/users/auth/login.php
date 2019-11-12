<div class="loginForm">
    <?php
    if(isset($data['loginError'])) {
        echo "<p style='color:red'>".$data['loginError']."</p>";
    }
    ?>
    <form method="POST"  action="?c=auth&m=login">
        <p> Uloguj se</p>
        <input placeholder="email" value="<?php echo (isset($data['email'])) ? $data['email']: '' ?>" name="email" type="text">

        <input placeholder="lozinka" value="" name="password" type="password">
        <br>

        <button type="submit" class="submmitBtn">Uloguj se</button>

    </form>

    <a href="?c=auth&m=register">
        <button type="button" class="regBtn">Registruj se</button>
    </a>
</div>