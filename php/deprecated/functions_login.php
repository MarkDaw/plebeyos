<?php
function checkCredentials($usuarios, $nombreUsuario, $contrasena) {
    if (isset($usuarios[$nombreUsuario])) {
        if (password_verify($contrasena, $usuarios[$nombreUsuario])) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}