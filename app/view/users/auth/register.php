<div class="loginForm">

    <form method="POST"  action="?c=auth&m=register">
        <p> Registruj se</p>
        <input name="user_registration" hidden>
        <input placeholder="email" value="<?php echo (isset($inputValues['email'])) ? $inputValues['email']: '' ?>" name="email" type="email">
        <input placeholder="ime" value="<?php echo (isset($inputValues['first_name'])) ? $inputValues['first_name']: '' ?>" name="first_name" type="input">
        <input placeholder="prezime" value="<?php echo (isset($inputValues['last_name'])) ? $inputValues['last_name']: '' ?>" name="last_name" type="input">

        <input placeholder="lozinka" value="" name="password" type="password">
        <input placeholder="potvrdi lozinku" value="" name="confirm_password" type="password">
        <br>
        <button type="submit" class="regBtn">Registruj se</button>
    </form>
</div>