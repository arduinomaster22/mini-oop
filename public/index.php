<?php

require __DIR__ . '/../bootstrap/app.php';

use App\Base\Variables\StringActions;

$first = 'Hello';
$second = 'Hello';

$value = '';

if (StringActions::isEqual($first, $second)) {
    $value = 'Strings are equal';
} else {
    $value = 'Strings are not equal';
}

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <?= \App\Base\Layout\Heading::getHeading() ?>
    <?= \App\Base\Layout\Heading::additionalScripts() ?>
    <?= \App\Base\Layout\Heading::additionalCss() ?>
</head>

<body>

    <?= \App\Base\Layout\Heading::extraImports(false) ?>
</body>

</html>