<?php
require __DIR__ . '/../vendor/autoload.php';

$builder = new \YuBuilder\Builder(__DIR__ . '/../config/template.yaml');
// Build new theme from base theme
$builder->build();

