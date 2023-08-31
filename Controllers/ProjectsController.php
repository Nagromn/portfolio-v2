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

            $this->render('projects/index', ['projects' => $projects]); // On passe en second argument un tableau contenant les variables à transmettre à la vue
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
                        $_SESSION['error'] = !empty($_POST) ? 'Le formulaire est incomplet' : ''; // On définit un message d'erreur
                        $projectName = isset($_POST['projectName']) ? strip_tags($_POST['projectName']) : ''; // On récupère le nom du projet
                        $content = isset($_POST['content']) ? strip_tags($_POST['content']) : ''; // On récupère le contenu du projet
                  }

                  $form = new Form; // Création d'un nouvel objet Form

                  // Création du formulaire d'ajout de projet
                  $form->formStart()
                        ->addLabel('projectName', 'Nom du projet')
                        ->addInput('text', 'projectName', [
                              'class' => 'form-control',
                              'required' => true
                        ])
                        ->addLabel('content', 'Contenu du projet')
                        ->addTextarea('content', '', [
                              'class' => 'form-control'
                        ])
                        ->addSubmit('Ajouter', [
                              'class' => 'btn btn-primary mt-3'
                        ])
                        ->formEnd();

                  $this->render('projects/create', ['projectForm' => $form->create()]); // On passe en second argument un tableau contenant les variables à transmettre à la vue
            } else {
                  $_SESSION['error'] = 'Vous devez être connecté pour accéder à cette page'; // On définit un message d'erreur
                  header('Location: ../admin/login'); // On redirige l'utilisateur vers la page de connexion
                  exit;
            }

            $this->render('projects/create', ['projectForm' => $form->create()]); // On passe en second argument un tableau contenant les variables à transmettre à la vue
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

            $this->render('projects/read', ['project' => $project]); // On passe en second argument un tableau contenant les variables à transmettre à la vue
      }

      /** 
       * Méthode permettant de modifier un projet
       * @param int $id ID du projet
       * @return void
       */
      public function update(int $id): void
      {
            if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
                  $project = new Project; // Création d'un nouvel objet Project

                  $project = $project->find($id); // On récupère le projet dont l'id correspond à celui passé en paramètre d'URL

                  // Si le formulaire n'existe pas
                  if (!$project) {
                        http_response_code(404); // On définit le code de statut à 404 (page non trouvée)
                        $_SESSION['error'] = 'Ce projet n\'existe pas'; // On définit un message d'erreur
                        header('Location: ../index'); // On redirige l'utilisateur vers la page d'accueil des projets
                        exit;
                  }

                  // On vérifie si l'utilisateur est propriétaire du projet
                  if ($project->user_id !== $_SESSION['user']['id']) {
                        http_response_code(403); // On définit le code de statut à 403 (accès interdit)
                        $_SESSION['error'] = 'Vous n\'avez pas accès à cette page'; // On définit un message d'erreur
                        header('Location: ../index'); // On redirige l'utilisateur vers la page d'accueil des projets
                        exit;
                  }

                  if (Form::validate($_POST, ['projectName', 'content'])) {
                        $projectName = strip_tags($_POST['projectName']); // On récupère le nom du projet
                        $content = strip_tags($_POST['content']); // On récupère le contenu du projet
                        $updatedAt = (new DateTime())->format('Y-m-d H:i:s'); // On récupère la date de modification du projet

                        $projectUpdate = new Project; // Création d'un nouvel objet Project

                        $projectUpdate->setId($id) // On définit l'ID du projet
                              ->setProjectName($projectName) // On définit le nom du projet
                              ->setContent($content) // On définit le contenu du projet
                              ->setUpdatedAt($updatedAt); // On définit la date de modification du projet

                        $projectUpdate->update(); // On met à jour le projet en base de données

                        $_SESSION['success'] = 'Le projet a bien été modifié'; // On définit un message de succès
                        header('Location: ../index'); // On redirige l'utilisateur vers la page d'accueil des projets
                        exit;
                  }

                  $form = new Form; // Création d'un nouvel objet Form

                  // Création du formulaire d'ajout de projet
                  $form->formStart()
                        ->addLabel('projectName', 'Nom du projet')
                        ->addInput('text', 'projectName', [
                              'class' => 'form-control',
                              'value' => $project->projectName,
                              'required' => true
                        ])
                        ->addLabel('content', 'Contenu du projet')
                        ->addTextarea('content', $project->content, [
                              'class' => 'form-control',
                              'required' => true
                        ])
                        ->addSubmit('Modifier', [
                              'class' => 'btn btn-primary mt-3'
                        ])
                        ->formEnd();

                  $this->render('projects/update', ['updateForm' => $form->create()]); // On passe en second argument un tableau contenant les variables à transmettre à la vue

            } else {
                  $_SESSION['error'] = 'Vous devez être connecté pour accéder à cette page'; // On définit un message d'erreur
                  header('Location: ../admin/login'); // On redirige l'utilisateur vers la page de connexion
                  exit;
            }
      }

      /** 
       * Méthode permettant de supprimer un projet
       * @param int $id ID du projet
       * @return void
       */
      public function delete(int $id)
      {
            $project = new Project; // Création d'un nouvel objet Project
            $project->setId($id); // On définit l'ID du projet
            $project->delete($id); // On supprime le projet en base de données

            $_SESSION['success'] = 'Le projet a bien été supprimé'; // On définit un message de succès
            header('Location: ../index'); // On redirige l'utilisateur vers la page d'accueil des projets
            exit;
      }
}
