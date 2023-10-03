<?php

require_once __DIR__ . './DB.php';

$path='./assets/db/Migrations.sql';

DB::Migration($path);
