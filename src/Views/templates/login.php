<?php
$errors = $errors ?? ['identifiant' => '']; 
?>

<div class="form_container">
    <h1 class="title_movie">Connexion</h1>
    <form method="POST" class="login_form">
        <div class="form_group">
            <label for="email" class="form_label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form_input" 
                placeholder="Entrez votre email" 
                required
            >
        </div>
        <div class="form_group">
            <label for="password" class="form_label">Mot de passe</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form_input" 
                placeholder="Entrez votre mot de passe" 
                required
            >
        </div>
        <?php if (!empty($errors['identifiant'])): ?>
            <p class="error text-danger"><?php echo htmlspecialchars($errors['identifiant']); ?></p>
        <?php endif; ?>
        <div class="form_group">
            <button name="login" type="submit" class="btn">
                Se connecter
            </button>
        </div>
    </form>
</div>
