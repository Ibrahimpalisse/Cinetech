<?php

?>

<div class="form_container">
    <h1 class="title_movie">Inscription</h1>
    <form  method="POST" class="registration_form">
        <div class="form_group">
            <label for="username" class="form_label">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" class="form_input"  value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>">
        </div>
        <div class="form_group">
            <label for="email" class="form_label">Email</label>
            <input type="email" id="email" name="email" class="form_input"  value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
        </div>
        <div class="form_group">
            <label for="password" class="form_label">Mot de passe</label>
            <input type="password" id="password" name="password" class="form_input"  value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>">
        </div>
        <div class="form_group">
            <label for="confirm_password" class="form_label">Confirmez le mot de passe</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form_input" placeholder="Confirmez votre mot de passe" required>
        </div>
        <div class="form_group">
            <button name="register" type="submit" class="btn">
                S'inscrire
            </button>
        </div>
    </form>
</div>
