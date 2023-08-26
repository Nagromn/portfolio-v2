<article>
      <h1><?= $project->projectName ?></a></h1>
      <p><?= $project->content ?></p>
      <p>Catégories associées :
            <?php foreach ($categories as $category) : ?>
                  <?= $category->category_name ?>
            <?php endforeach ?>
      </p>
</article>