<?php
ob_start();
include_once "base.php";

ob_start();
include_once '../DASHBOARD/view/userView.php';
$layout = isset($layout) ? $layout : '';  
$content = isset($content) ? $content : '';  

$layout = str_replace('{{ script }}', '<script type="text/javascript" src="assets/js/user.js"></script>', $layout);
echo str_replace('{{ content }}', $content, $layout);
?>