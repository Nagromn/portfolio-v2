<article>
      <h1><?= $project->projectName ?></a></h1>
      <p>Description : <?= $project->content ?></p>
      <p>Ajouté le : <?= $project->createdAt ?></p>
      <p>Modifié le : <?= $project->updatedAt ?? 'Pas de modification' ?></p>
</article>