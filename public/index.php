<?php

require __DIR__ . '/../bootstrap/app.php';

use App\Actions\Variables\StringActions;

$first = 'Hello';
$second = 'Hello';

$value = null;

if (StringActions::isEqual($first, $second)) {
    $value = 'Strings are equal';
} else {
    $value = 'Strings are not equal';
}

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <?= \App\Actions\Layout\Heading::getHeading() ?>
    <?= \App\Actions\Layout\Heading::additionalScripts() ?>
    <?= \App\Actions\Layout\Heading::additionalCss() ?>
</head>

<body>

    <?= \App\Actions\Layout\Heading::extraImports(false) ?>
</body>

</html>