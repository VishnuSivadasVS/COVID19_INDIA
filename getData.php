<?php
/*
 * Developer: VishnuSivadasVS
 * Website: https://www.vishnusivadas.com
 * Github: https://github.com/VishnuSivadasVS
 * API: https://staysafe.vishnusivadas.com/apis/covid19_india.php
 */
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
        if($thHTML[$j] == "S. No.")
            $thHTML[$j] = "State Number";
        elseif ($thHTML[$j] == "Name of State / UT")
            $thHTML[$j] = "Name of State or UT";
        elseif ($thHTML[$j] == "Total Confirmed cases*")
            $thHTML[$j] = "Confirmed cases";
        elseif ($thHTML[$j] == "Cured/Discharged/Migrated")
            $thHTML[$j] = "Cured or Discharged or Migrated";
        elseif ($thHTML[$j] == "Deaths**")
            $thHTML[$j] = "Deaths";
        $tempData[$i][$thHTML[$j]] = $dataHTML[$i][$j];
    }
}
$dataHTML = $tempData;
unset($tempData);
echo json_encode(array("COVID19IN" => $dataHTML), JSON_PRETTY_PRINT);

?>
