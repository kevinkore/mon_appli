<?php

include "pdo.php";
$exo=new pdoConnect("localhost","spotifs","root","Kevin_18");
$datas = $exo->connex()->query('CREATE DATABASE IF NOT EXISTS sportifs');
$req=$datas->fetchAll(PDO::FETCH_CLASS );