<label for="filInfo">Filières informatiques:*</label>
<dl class="radio-list-left" required>
<dd>
    <input type="radio" name="filInfo" id="fill1" value="developpementApplications" <?php echo ($_SESSION['postedForm']['filInfo'] == "developpementApplications") ? "checked=\"checked\"" : ''; ?>/>
    <label for="fill1">Développement d'application</label>
</dd>
<dd>
    <input type="radio" name="filInfo" id="fill2" value="entreprise" <?php echo ($_SESSION['postedForm']['filInfo'] == "entreprise") ? "checked=\"checked\"" : ''; ?>/>
    <label for="fill2">Informatique d'entreprise</label>
</dd>
<dd>
    <input type="radio" name="filInfo" id="fill3" value="techniqueSysteme" <?php echo ($_SESSION['postedForm']['filInfo'] == "techniqueSysteme") ? "checked=\"checked\"" : ''; ?>/>
    <label for="fill3">Technique des systèmes</label>
</dd>
<dd>
   <input type="radio" name="filInfo" id="fill4" value="neSaisPas" <?php echo (!isset($_SESSION['postedForm']['filInfo']) || $_SESSION['postedForm']['mpt'] == "neSaisPas") ? "checked=\"checked\"" : ''; ?> />
   <label for="fill4">Je ne sais pas</label>
</dd>
</dl>
<button type="button" id="infoFilieres" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
    Infos sur les filières
</button>