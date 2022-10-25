<?php

namespace SYRADEV\AutoEncheres\Controllers;

/*
 *  Classe de gestion des erreurs étendue depuis la classe Controller.
 */
class Errors extends Controller
{
    /*
     * Afffiche les erreurs apache
     */
    public function errorDisplay($errorNum): array|string
    {
        return $this->render('layouts.default','templates.errors', $errorNum);
    }

}