<div class="container">
    <div class="row">
        <div class="col-6 mt-3 mb-3 mx-auto">
            <h1 class="text-white">Veuillez vous enregistrer</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mt-3 mb-3 mx-auto">
            <div class="card">
                <div class="card-body" id="registerZone">
                    <form id="registerform">
                        <div class="form-group has-validation mb-3">
                            <label for="nom" class="form-label">Nom :</label>
                            <input type="text" class="form-control" name="nom" id="nom" required autofocus>
                            <div class="invalid-feedback">Veuillez saisir un nom !</div>
                            <input type="hidden" name="register" value="1">
                        </div>
                        <div class="form-group has-validation mb-3">
                            <label for="prenom" class="form-label">Prénom :</label>
                            <input type="text" class="form-control" name="prenom" id="prenom" required>
                            <div class="invalid-feedback">Veuillez saisir un prénom !</div>
                        </div>
                        <div class="form-group has-validation mb-3">
                            <label for="email" class="form-label">Courriel :</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                            <div class="invalid-feedback">Veuillez saisir un courriel valide !</div>
                        </div>
                        <div class="form-group has-validation mb-3">
                            <label for="password" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                            <div class="invalid-feedback">Veuillez saisir un mot de passe !</div>
                        </div>
                        <div class="form-group has-validation mb-3">
                            <label for="password2" class="form-label">Confirmation mot de passe :</label>
                            <input type="password" class="form-control" name="password2" id="password2" required>
                            <div class="invalid-feedback">Veuillez confirmer le mot de passe !</div>
                            <label for="escobar"></label>
                            <input type="text" id="escobar" name="escobar">
                        </div>
                        <div class="form-group">
                            <button type="button" id="register-btn" class="btn btn-outline-primary float-end">S'enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>