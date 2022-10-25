<div class="container">
    <div class="row">
        <div class="col-6 mt-3 mb-3 mx-auto">
            <h1 class="text-white">Veuillez vous connecter</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mt-3 mb-3 mx-auto">
            <div class="card">
                <div class="card-body">
                   <!-- Formulaire traité en Ajax avec Fetch, ne comporte qu'un id. -->
                    <form id="loginform" autocomplete="off">
                        <div class="form-group has-validation mb-3">
                            <label for="email" class="form-label">Courriel :</label>
                            <input type="email" class="form-control" name="email" id="email" required autofocus>
                            <div class="invalid-feedback">Veuillez saisir un courriel valide !</div>
                            <input type="hidden" name="login" value="1">
                        </div>
                        <div class="form-group has-validation mb-3">
                            <label for="password" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                            <div class="invalid-feedback">Veuillez saisir votre mot de passe !</div>
                            <label for="escobar"></label>
                            <input type="text" id="escobar" name="escobar">
                        </div>
                        <div class="form-group">
                            <button id="login-btn" type="button" class="btn btn-outline-primary float-end">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    Vous n'avez pas de compte : <a href="/register">S'enregistrer</a>
                </div>
            </div>
        </div>
    </div>
</div>