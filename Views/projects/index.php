<h1>Page d'accueil des projets</h1>

<?php foreach ($projectsWithCategories as $projectWithCategories) : ?>
      <article>
            <h2><a href="/dev/portfolio-v2/public/projects/read/<?= $projectWithCategories['project']->id ?>">
                        <?= $projectWithCategories['project']->projectName ?>
                  </a></h2>
            <p><?= $projectWithCategories['project']->content ?></p>

            <?php if (!empty($projectWithCategories['categories'])) : ?>
                  <p>Catégories associées :
                        <?php foreach ($projectWithCategories['categories'] as $category) : ?>
                              <?= $category->category_name ?> |
                        <?php endforeach ?>
                  </p>
            <?php endif ?>

            <hr>
      </article>
<?php endforeach ?>