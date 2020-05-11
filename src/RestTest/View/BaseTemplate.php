<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 01.05.2020
 * Time: 0:23
 */

namespace RestTest\View;

use RestTest\Service\AuthMgn;


class BaseTemplate
{
    public function render($title, $pageContent)
    {
        $homePart = '<a href="/">Home</a>';
        return "<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta name=\"viewport\" content=\"width=device-width, user-scalable=yes, initial-scale=1\">
<meta charset=\"utf-8\">
<script type=\"text/javascript\" src=\"/assets/js/rest-test.js\"></script>
<title>$title</title>
</head>
<body>
$pageContent
<div style='margin-top: 100px;'>
<hr>
<p>
$homePart
</p>
</div>
</body>
</html>";
    }

}