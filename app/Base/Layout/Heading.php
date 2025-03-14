<?php

namespace App\Base\Layout;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Heading
{
    public static function getHeading(): Htmlable
    {
        return new HtmlString(<<<'HTML'
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="https://cdn.tailwindcss.com">
            HTML);
    }

    public static function extraImports(bool $inHeading): Htmlable
    {
        if ($inHeading) {
            return new HtmlString(<<<'HTML'
            <!-- Add imports like css and jvascript here that you like to have in the <head> tag -->
            HTML);
        } else {
            return new HtmlString(<<<'HTML'
            <!-- Add imports like css and jvascript here that you like to have at the end of the <body> tag -->

            HTML);
        }
    }

    public static function additionalScripts(): Htmlable
    {
        $disableCachePraram = static::disableCachePraram();

        return new HtmlString(<<<HTML
            <script src="/build/js/app.js?$disableCachePraram"></script>
            HTML);
    }

    public static function additionalCss(): Htmlable
    {
        $disableCachePraram = static::disableCachePraram();

        return new HtmlString(<<<HTML
            <link rel="stylesheet" href="/build/css/app.css?$disableCachePraram>">
            HTML);
    }

    public static function disableCachePraram()
    {
        return Str::random(10);
    }
}
