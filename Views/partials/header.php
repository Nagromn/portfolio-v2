<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
            <a class="navbar-brand" href="#">Portfolio-v2</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav">
                        <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="../../public/main/index">Accueil</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="../../public/main/skills">Compétences et formations</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="../../public/main/experiences">Expériences</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="../../public/main/projects">Projets</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="../../public/main/contact">Contact</a>
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
