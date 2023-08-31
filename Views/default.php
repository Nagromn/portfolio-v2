<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Portfolio-v2</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="m-0">
      <header>
            <?= $header ?>
      </header>

      <main>
            <!-- Afficher les messages d'erreurs de la session -->
            <?php if (!empty($_SESSION['error'])) : ?>
                  <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                  </div>
            <?php endif; ?>
            <!-- Afficher les messages de succès de la session -->
            <?php if (!empty($_SESSION['success'])) : ?>
                  <div class="alert alert-success" role="alert">
                        <?= $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                  </div>
            <?php endif; ?>

            <!-- Contenu de la page -->
            <?= $content; ?>
      </main>

      <footer>
            <?= $footer ?>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>