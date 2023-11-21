<?php 

error_reporting(E_ALL);
ini_set('display_startup_errors', '1');
ini_set('display_errors', 1);

// Switch folders
chdir('../../repositories/demo-2023-08-29a/'); // <---- Set path to Git Repo

require 'public-web/index.php';
