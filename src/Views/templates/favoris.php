
  <h1>Mes Favoris</h1>
  <?php if (!empty($favoris)): ?>
      <ul>
          <?php foreach ($favoris as $favori): ?>
              <li>
                  ID: <?= htmlspecialchars($favori['id']) ?> - Type: <?= htmlspecialchars($favori['type']) ?>
              </li>
          <?php endforeach; ?>
      </ul>
  <?php else: ?>
      <p>Vous n'avez pas encore de favoris.</p>
  <?php endif; ?>