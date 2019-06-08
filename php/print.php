<?php
//    session_start();
//    $_SESSION['login'] = 'noiselesskill';
//    $_SESSION['office'] = 'На даламановском 10';
    $setCreator = $_SESSION['login'];
    $location = $_SESSION['office'];
    
    include("connect_to_bd.php");
    //Получаем название офиса
    $getoffice = $dbh -> prepare("SELECT location FROM offices WHERE id = '$location'");
    $getoffice -> execute();
    while($row = $getoffice -> fetch()){
        $getoffices = $row['location'];
    }
    //Полуаем id заказа
    $getid = $dbh -> prepare('SELECT id FROM orders ORDER BY id DESC LIMIT 1');
    $getid -> execute();
    while($row = $getid -> fetch()){
        $idoforder = $row['id'];
    }
    $datefrom = date('Y-m-d');

    require '../vendor/autoload.php';
    
    $phpWord = new \PhpOffice\PhpWord\PhpWord();

    $phpWord ->  setDefaultFontName('Times New Roman');
    $phpWord -> setDefaultFontSize(14);

    $properties = $phpWord->getDocInfo();
    $properties->setCreator($setCreator);
    $properties->setCompany('My factory');
    $properties->setTitle('My title');
    $properties->setDescription('My description');
    $properties->setCategory('My category');
    $properties->setLastModifiedBy('My name');
    $properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
    $properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
    $properties->setSubject('My subject');
    $properties->setKeywords('my, key, word');

    $sectionStyle = array(
        'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(20),
        'marginLeft' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(20),
        'marginRight' =>\PhpOffice\PhpWord\Shared\Converter::pixelToTwip(20),
        'colsNum'=>2,
    );
    $section = $phpWord -> addSection($sectionStyle);
    
    $text = ("Сервисный центр: ".$getoffices);
    $section->addText(htmlSpecialChars($text), array('name' => 'Arial', 'size'=>10), array('align'=>'left'));

    $text = ("Сервисный центр 2: ".$location);
    $section->addText(htmlSpecialChars($text), array('name' => 'Arial', 'size'=>10), array('align'=>'left'));

    $text = ("АКТ ПРЁМА ТОВАРА НА РЕМОНТ № ".$idoforder." ОТ ".$datefrom);
    $section->addText(htmlSpecialChars($text), array('name' => 'Arial', 'size'=>10), array('align'=>'left'));


//    $section->addTextBreak();Пустой отступ

    $text = ("Сервисный центр: 4 ".$location);
    $section->addText(htmlSpecialChars($text), array('name' => 'Arial', 'size'=>10), array('align'=>'right'));
    $text = ("Сервисный центр: 5".$location);
    $section->addText(htmlSpecialChars($text), array('name' => 'Arial', 'size'=>10), array('align'=>'right'));

    $section = $phpWord->addSection(['breakType' => 'continuous', 'colsNum' => 2]);

//    $header = array('size' => 16, 'bold' => true);

    //Доававление таблицы
$header = array('size' => 16, 'bold' => true);
//    $section->addPageBreak();
$section->addText('Table with colspan and rowspan', $header);
$fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999');
$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFF00');
$cellRowContinue = array('vMerge' => 'continue');
$cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
$cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
$cellVCentered = array('valign' => 'center');
$spanTableStyleName = 'Colspan Rowspan';
$phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
$table = $section->addTable($spanTableStyleName);
$table->addRow();
$cell1 = $table->addCell(2000, $cellRowSpan);
$textrun1 = $cell1->addTextRun($cellHCentered);
$textrun1->addText('A');
$textrun1->addFootnote()->addText('Row span');
$cell2 = $table->addCell(4000, $cellColSpan);
$textrun2 = $cell2->addTextRun($cellHCentered);
$textrun2->addText('B');
$textrun2->addFootnote()->addText('Column span');
$table->addCell(2000, $cellRowSpan)->addText('E', null, $cellHCentered);
$table->addRow();
$table->addCell(null, $cellRowContinue);
$table->addCell(2000, $cellVCentered)->addText('C', null, $cellHCentered);
$table->addCell(2000, $cellVCentered)->addText('D', null, $cellHCentered);
$table->addCell(null, $cellRowContinue);

    //Создание документа
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save("Договор № '$idoforder'$.docx");

    if($objWriter == true){
        echo "Выполнено";
    }else{
        echo "Ошибка";
    }
?>