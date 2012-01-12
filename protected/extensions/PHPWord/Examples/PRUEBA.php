<?php
require_once '../PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('PRUEBA.docx');

$document->setValue('ced1','V-16409874');
$document->setValue('ced2','V-4207631');
$document->setValue('ced3','');
$document->setValue('q1','12');
$document->setValue('q2','13');
$document->setValue('q3','9');


$document->save('PRUEBASALIDA.docx');
?>