<?php
ob_start();
include_once "loginbase.php";

ob_start();
include_once '../DASHBOARD/view/loginView.php';
$layout = isset($layout) ? $layout : '';  
$content = isset($content) ? $content : '';  

$layout = str_replace('{{ script }}', '<script type="text/javascript" src="assets/js/dashboard.js"></script>', $layout);
echo str_replace('{{ content }}', $content, $layout);
?>