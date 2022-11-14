<?php
session_start();
echo "logging you ouy please wait..";
session_destroy();
header("Location:/website")
?>