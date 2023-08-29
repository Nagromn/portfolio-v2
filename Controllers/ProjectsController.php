<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\Project;
use DateTime;

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

            $projects = $projects->findAll(); // On récupère tous les projets

            $this->render('projects/index', compact('projects')); // On passe en second argument un tableau contenant les variables à transmettre à la vue
      }

      /** 
       * Méthode permettant d'ajouter un projet
       * @return void
       */
      public function create(): void
      {
            // Si l'utilisateur est connecté et qu'il a un ID en session
            if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
                  // Si le formulaire a été soumis et que les champs requis sont remplis
                  if (Form::validate($_POST, ['projectName', 'content'])) {
                        $projectName = strip_tags($_POST['projectName']); // On récupère le nom du projet
                        $content = strip_tags($_POST['content']); // On récupère le contenu du projet
                        $createdAt = (new DateTime())->format('Y-m-d H:i:s'); // On récupère la date de création du projet

                        $project = new Project; // Création d'un nouvel objet Project
                        $project->setprojectName($projectName) // On définit le nom du projet
                              ->setContent($content) // On définit le contenu du projet
                              ->setCreatedAt($createdAt) // On définit la date de création du projet
                              ->setUserId($_SESSION['user']['id']); // On définit l'ID de l'utilisateur

                        $project->create(); // On crée le projet en base de données

                        $_SESSION['success'] = 'Le projet a bien été ajouté'; // On définit un message de succès
                        header('Location: ../projects/index'); // On redirige l'utilisateur vers la page d'accueil des projets
                        exit;
                  } else {
                        $_SESSION['error'] = 'Le formulaire est incomplet'; // On définit un message d'erreur
                  }

                  $form = new Form; // Création d'un nouvel objet Form

                  // Création du formulaire d'ajout de projet
                  $form->formStart()
                        ->addLabel('projectName', 'Nom du projet')
                        ->addInput('text', 'projectName', ['class' => 'form-control', 'required' => true])
                        ->addLabel('content', 'Contenu du projet')
                        ->addTextarea('content', '', ['class' => 'form-control', 'required' => true])
                        ->addSubmit('Ajouter', ['class' => 'btn btn-primary mt-3'])
                        ->formEnd();

                  $this->render('projects/create', ['projectForm' => $form->create()]); // On passe en second argument un tableau contenant les variables à transmettre à la vue
            } else {
                  $_SESSION['error'] = 'Vous devez être connecté pour accéder à cette page'; // On définit un message d'erreur
                  header('Location: ../admin/login'); // On redirige l'utilisateur vers la page de connexion
                  exit;
            }

            $this->render('projects/create');
      }

      /** 
       * Méthode permettant d'afficher un projet
       * @param int $id ID du projet
       * @return void
       */
      public function read(int $id): void
      {
            $project = new Project;

            $project = $project->find($id); // On récupère le projet dont l'id correspond à celui passé en paramètre d'URL

            $this->render('projects/read', compact('project')); // On passe en second argument un tableau contenant les variables à transmettre à la vue
      }
}
