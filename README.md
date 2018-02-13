# YuThemeBuilder
This is a theme builder for OctoberCMS.

## INTRODUCTION
Because OctoberCMS does not support a child theme feature. Web agencies usually need to maintain a base theme constantly and build a child theme which based on the base theme for client needs. In this case, web agencies can keep the base theme clean and maintainable.

This is a simple and lightweight tool to generate a new theme from the base theme you want by setting up the configuration.

## How to use
``` php
<?php
require __DIR__ . '/../vendor/autoload.php';

$builder = new \YuBuilder\Builder(__DIR__ . '/../config/template.yaml');
// Build new theme from base theme
$builder->build();

```

## Todo List
1. Merge oc-bootstrapper feature (https://github.com/OFFLINE-GmbH/oc-bootstrapper)
2. Add template parser, make this tool able to add module dependencies to the partials, cms pages

## Contribution
If you have any ideas, or find any bugs please create an issue for it.