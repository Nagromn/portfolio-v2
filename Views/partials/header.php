<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
            <a class="navbar-brand" href="#">Portfolio-v2</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav">
                        <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="">Accueil</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="">Compétences et formations</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="">Expériences</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="">Projets</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>
                              <li class="nav-item">
                                    <a class="nav-link" href="../../public/admin/index">Administration</a>
                              </li>
                              <li class="nav-item">
                                    <a class="nav-link" href="../../public/admin/logout">Déconnexion</a>
                              </li>
                        <?php else : ?>
                              <li class="nav-item">
                                    <a class="nav-link" href="../../public/admin/login">Connexion</a>
                              </li>
                        <?php endif; ?>
                  </ul>
            </div>
      </div>
</nav>

<!-- Afficher les messages d'erreurs de la session -->
<?php if (isset($_SESSION['error'])) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
<?php endif; ?>
<!-- Afficher les messages de succès de la session -->
<?php if (isset($_SESSION['success'])) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success']; ?>
            <?php unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
<?php endif; ?>