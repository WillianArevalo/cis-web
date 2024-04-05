<?php

class ErrorControlador
{
    public function index()
    {
        cargar_vista("error", "index", [], true, false);
    }
}
