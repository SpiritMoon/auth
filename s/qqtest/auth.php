<?php

session_start();

include_once('../../config.php');
$site = get_site(__DIR__);
define('SITE_PATH', $site);
include_once (CONFIG_PATH . '/' . $site . PHP_EXT);
include_once(QQ_PATH . '/qqConnectAPI.php');


$qc = new QC();
$qc->qq_login();