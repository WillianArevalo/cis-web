<?php
@session_start();
$role = $_SESSION['usuario']['rol'] ?? 'becado';
require_once 'app/vistas/layout/navbars/' . $role . '.php';
