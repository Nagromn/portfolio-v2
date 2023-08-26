<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;

/**
 * Controller permettant de gérer les projets
 * @package App\Controllers
 */
class ProjectsController extends Controller
{
      /** 
       * Méthode permettant d'afficher tous les projets
       * @return void
       */
      public function index(): void
      {
            $projects = new Project;
            $projectCategoryModel = new ProjectCategory;

            $projects = $projects->findAll(); // On récupère tous les projets

            $projectsWithCategories = []; // On initialise un tableau vide qui contiendra les projets avec leurs catégories

            // Récupérer les catégories associées à chaque projet
            foreach ($projects as $project) {
                  $projectCategories = $projectCategoryModel->getCategoriesByProjectId($project->id);
                  $projectsWithCategories[] = [
                        'project' => $project,
                        'categories' => $projectCategories
                  ];
            }

            $this->render('projects/index', compact('projectsWithCategories')); // On passe en second argument un tableau contenant les variables à transmettre à la vue
      }

      /** 
       * Méthode permettant d'afficher un projet
       * @param int $id ID du projet
       * @return void
       */
      public function read(int $id): void
      {
            $project = new Project;
            $projectCategoryModel = new ProjectCategory;

            $categories = $projectCategoryModel->getCategoriesByProjectId($id); // On récupère les catégories associées au projet

            $project = $project->find($id); // On récupère le projet dont l'id correspond à celui passé en paramètre d'URL

            $this->render('projects/read', compact('project', 'categories')); // On passe en second argument un tableau contenant les variables à transmettre à la vue
      }
}
