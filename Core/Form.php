<?php

namespace App\Core;

class Form
{
      private $formCode = '';

      /**
       * Crée un formulaire
       * @return string
       */
      public function create()
      {
            return $this->formCode;
      }

      /**
       * Valide un formulaire en vérifiant que les champs sont présents et remplis ($_POST, $_GET)
       * @param array $form Le formulaire à valider
       * @param array $fields Les champs à valider
       * @return bool
       */
      public static function validate(array $form, array $fields)
      {
            // Vérifie que les champs sont présents dans le formulaire
            foreach ($fields as $field) {
                  // Si le champ n'est pas présent ou vide dans le formulaire
                  if (!isset($form[$field]) || empty($form[$field])) {
                        return false;
                  }
            }

            return true;
      }

      /**
       * Ajoute les attributs à un élément HTML
       * @param array $attributes Tableau associatifs des attributs ['class' => 'form-control', 'required' => true]
       * @return string Les attributs sous forme de chaîne de caractères
       */
      private function addAttributes($attributes): string
      {
            $str = ''; // Chaîne de caractères qui contiendra les attributs

            $arr = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate']; // Attributs sans valeur

            // Parcours les attributs et leurs valeurs dans le tableau associatif
            foreach ($attributes as $attribute => $value) {
                  // Si l'attribut est dans la liste des attributs sans valeur
                  if (in_array($attribute, $arr) && $value == true) {
                        $str .= " $attribute"; // Ajoute l'attribut sans valeur à la chaîne de caractères
                  } else {
                        $str .= " $attribute=\"$value\""; // Ajoute l'attribut et sa valeur à la chaîne de caractères
                  }
            }

            return $str; // Retourne la chaîne de caractères contenant les attributs et leurs valeurs
      }

      /**
       * Balise d'ouverture d'un formulaire
       * @param string $method La méthode d'envoi du formulaire (post ou get)
       * @param string $action L'URL de destination du formulaire
       * @param array $attributes Les attributs du formulaire
       * @return Form
       */
      public function formStart(string $method = 'post', string $action = '#', array $attributes = []): self
      {
            $this->formCode .= "<form action='$action' method='$method'"; // Ajoute l'attribut action et method au formulaire (ex: <form action="#" method="post">)

            // Ajoute les attributs au formulaire
            $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

            return $this; // Retourne l'objet Form
      }

      /**
       * Balise de fermerture d'un formulaire
       * @return Form
       */
      public function formEnd(): self
      {
            $this->formCode .= '</form>'; // Ajoute la balise de fermeture du formulaire

            return $this; // Retourne l'objet Form
      }

      /**
       * Ajoute le <label> d'un champ de formulaire
       * @param string $for L'attribut for du label
       * @param string $text Le texte du label
       * @param array $attributes Les attributs du label
       * @return Form
       */
      public function addLabel(string $for, string $text, array $attributes = []): self
      {
            $this->formCode .= "<label for='$for'"; // Ajoute l'attribut for au label (ex: <label for="email">)

            // Ajoute les attributs au label
            $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

            $this->formCode .= $text . '</label>'; // Ajoute le texte et la balise de fermeture du label

            return $this; // Retourne l'objet Form
      }

      /**
       * Ajoute un champ de formulaire de type input
       * @param string $type Le type de l'input
       * @param string $name L'attribut name de l'input
       * @param array $attributes Les attributs de l'input
       * @return Form
       */
      public function addInput(string $type, string $name, array $attributes = []): self
      {
            $this->formCode .= "<input type='$type' name='$name'"; // Ajoute les attributs type et name à l'input (ex: <input type="email" name="email">)

            // Ajoute les attributs à l'input
            $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

            return $this; // Retourne l'objet Form
      }

      /**
       * Ajoute un champ de formulaire de type textarea
       * @param string $name
       * @param string $value
       * @param array $attributes
       * @return Form
       */
      public function addTextArea(string $name, string $value = '', array $attributes = []): self
      {
            $this->formCode .= "<textarea name='$name'"; // Ajoute l'attribut name à la textarea (ex: <textarea name="content">)

            // Ajoute les attributs à la textarea
            $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

            $this->formCode .= $value . '</textarea>'; // Ajoute la valeur et la balise de fermeture de la textarea

            return $this; // Retourne l'objet Form
      }

      /**
       * Ajoute un champ de formulaire de type select
       * @param string $name
       * @param array $options
       * @param array $attributes
       * @return Form
       */
      public function addSelect(string $name, array $options, array $attributes = []): self
      {
            $this->formCode .= "<select name='$name'"; // Ajoute l'attribut name au select (ex: <select name="category">)

            // Ajoute les attributs au select
            $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

            // Parcours les options du select
            foreach ($options as $value => $text) {
                  $this->formCode .= "<option value=\"$value\">$text</option>"; // Ajoute l'option et la balise de fermeture de l'option
            }

            $this->formCode .= '</select>'; // Ajoute la balise de fermeture du select

            return $this; // Retourne l'objet Form
      }

      /**
       * Ajoute un champ de formulaire de type submit
       * @param string $text
       * @param array $attributes
       * @return Form
       */
      public function addSubmit(string $text, array $attributes = []): self
      {
            $this->formCode .= "<button type='submit'"; // Ajoute l'attribut type au bouton (ex: <button type="submit">)

            // Ajoute les attributs au bouton
            $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

            $this->formCode .= $text . '</button>'; // Ajoute le texte et la balise de fermeture du bouton

            return $this; // Retourne l'objet Form
      }
}
