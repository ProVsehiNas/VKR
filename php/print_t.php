<?php

$maked = 'СТАСИК';

require_once '../vendor/autoload.php';
$document = new \PhpOffice\PhpWord\TemplateProcessor('Akt_priema.docx');

//$document = $phpWord -> TemplateProcessor();
$document -> setValue('name', $maked);
var_dump($document);


$document -> saveAs("result.docx");


echo 'Успешно';
?>

