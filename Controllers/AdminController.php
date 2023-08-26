<?php

namespace App\Controllers;

use App\Core\Form;

/**
 * Controller administrateur
 * @package App\Controllers
 */

class AdminController extends Controller
{
      /**
       * Affiche la page d'administration
       */
      public function index(): void
      {
            $this->render('admin/index');
      }

      /**
       * Affiche la page de login de l'administrateur
       */
      public function login(): void
      {
            $form = new Form;

            $form->formStart()
                  ->addLabel('email', 'Email : ')
                  ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'required' => true])
                  ->addLabel('password', 'Mot de passe : ')
                  ->addInput('password', 'password', ['id' => 'password', 'class' => 'form-control', 'autofocus' => true])
                  ->addSubmit('Se connecter', ['class' => 'btn btn-primary'])
                  ->formEnd();

            $this->render('admin/login', ['form' => $form->create()]);
      }

      /**
       * Affiche la page de création d'un projet
       */
      public function create(): void
      {
            $this->render('admin/create');
      }
}
