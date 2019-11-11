<div class="loginForm">
    <?php
    if(isset($data['registerError'])) {
        echo "<p style='color:red'>".$data['registerError']."</p>";
    }
    ?>
    <form method="POST"  action="?c=users&m=registerUser">
        <p> Ulogujte se</p>
        <input placeholder="email" value="<?php echo (isset($data['email'])) ? $data['email']: '' ?>" name="email" type="email">
        <input placeholder="ime" value="<?php echo (isset($data['first_name'])) ? $data['first_name']: '' ?>" name="first_name" type="input">
        <input placeholder="prezime" value="<?php echo (isset($data['last_name'])) ? $data['last_name']: '' ?>" name="last_name" type="input">

        <input placeholder="lozinka" value="" name="password" type="password">
        <input placeholder="potvrdi lozinku" value="" name="confirm_password" type="password">
        <br>
        <button type="submit" class="submmitBtn">Registruj se</button>
    </form>
</div>