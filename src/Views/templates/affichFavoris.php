
<h1>Mes Favoris</h1>
<?php if (!empty($favoris)): ?>
    <ul>
        <?php foreach ($favoris as $favori): ?>
            <li>
                <?= htmlspecialchars($favori['media_type']) ?> - ID: <?= htmlspecialchars($favori['media_id']) ?>
                <!-- Ajoutez ici des liens ou des informations supplémentaires sur le média -->
            </li>
        <?php endforeach; ?>
   

 
