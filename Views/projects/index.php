<h1>Page d'accueil des projets</h1>
<table class="table">
      <thead>
            <tr>
                  <th scope="col">Nom du projet :</th>
                  <th scope="col">Modifier</th>
                  <th scope="col">Supprimer</th>
            </tr>
      </thead>
      <tbody>
            <?php foreach ($projects as $project) : ?>
                  <tr>
                        <td>
                              <a href="../projects/read/<?= $project->id ?>"><?= $project->projectName ?></a>
                        </td>
                        <td>
                              <a href="../projects/update/<?= $project->id ?>" class="btn btn-primary">Modifier</a>
                        </td>
                        <td>
                              <a href="../projects/delete/<?= $project->id ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                  </tr>
            <?php endforeach ?>
      </tbody>
</table>