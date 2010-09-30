<?php

require_once 'classes/markdown.php';

$m = new Markdown();

//transform another file
echo $m->transform(file_get_contents('README.md'));
//transforming some string
echo $m->transform('##License');
//transform another file
echo $m->transform(file_get_contents('License.md'));