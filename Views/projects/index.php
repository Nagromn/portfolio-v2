<h1>Page d'accueil des projets</h1>

<?php foreach ($projects as $project) : ?>
      <article>
            <h2><a href="../../public/projects/read/<?= $project->id ?>"><?= $project->projectName ?></a></h2>
      </article>
<?php endforeach ?>