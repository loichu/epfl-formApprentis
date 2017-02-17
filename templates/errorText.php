<p style="color:red; font-size: 25px;">Des erreurs se sont produites, merci de remplir tous les champs obligatoires!</p>
<div id="formErrorsDiv" style="padding-bottom: 20px;">
  <?php
  // TODO messages d'erreurs !!!
  print_r($validator->errors());
  ?>
</div>
<footer>
  <button type="button" id="retourFormulaire" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
    Retour au formulaire
  </button>
</footer>
