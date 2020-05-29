<?php
require "simple_html_dom.php";
header('Content-Type: application/json');
$html = file_get_html("https://www.mohfw.gov.in/");
$table = $html->find('table', 0);
$DOM = new DOMDocument();
$DOM->loadHTML($table);
$Header = $DOM->getElementsByTagName('th');
$Detail = $DOM->getElementsByTagName('td');
foreach ($Header as $NodeHeader) {
    $thHTML[] = trim($NodeHeader->textContent);
}
$i = 0;
$j = 0;
foreach ($Detail as $node) {
    $dataHTML[$j][] = trim($node->textContent);
    $i = $i + 1;
    $j = $i % count($thHTML) == 0 ? $j + 1 : $j;
}

for ($i = 0; $i < count($dataHTML); $i++) {
    for ($j = 0; $j < count($thHTML); $j++) {
        $tempData[$i][$thHTML[$j]] = $dataHTML[$i][$j];
    }
}
$dataHTML = $tempData;
unset($tempData);
echo json_encode(array("IndiaCovid19Details" => $dataHTML), JSON_PRETTY_PRINT);

?>
