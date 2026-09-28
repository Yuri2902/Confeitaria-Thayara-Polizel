<?php
require_once __DIR__ . '/config.php';

fazerLogout();

header('Location: ' . BASE_URL . '/index.php');
exit;
