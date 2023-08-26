<form action="/dev/portfolio-v2/public/admin/create" method="post">
      <label for="projectName">Nom du projet:</label>
      <input type="text" name="projectName" id="projectName" required><br>

      <label for="images">Images:</label>
      <input type="file" name="images[]" id="images" multiple accept="image/*"><br>

      <label for="categories">Catégories:</label>
      <select name="categories[]" id="categories" multiple>
            <!-- <option value="1"> ... </option> -->
            <!-- <option value="2">Catégorie 2</option> -->
      </select><br>

      <label for="content">Contenu:</label>
      <textarea name="content" id="content" rows="4" required></textarea><br>

      <button type="submit">Ajouter le projet</button>
</form>