<?php

require __DIR__.'/../bootstrap/app.php';

use App\Base\Connections\Database\Builder;
use App\Base\Variables\StringActions;

$first = 'Hello';
$second = 'Hello';

$value = null;

if (StringActions::isEqual($first, $second)) {
    $value = 'Strings are equal';
} else {
    $value = 'Strings are not equal';
}

$output = new Builder;

$output->table('users');

$data = $output->where('gpg_version', 'gpg');

if ($data) {
    dd($data);
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