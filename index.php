<?php

$url = "https://www.mohfw.gov.in/data/datanew.json";
$data = file_get_contents($url);
$data = json_decode($data, true);

if ($data) {
    foreach ($data as $item) {
        echo "State: " . $item['state_name'] . "<br>";
        echo "Active Cases: " . $item['active'] . "<br>";
        echo "Positive Cases: " . $item['positive'] . "<br>";
        echo "Cured Cases: " . $item['cured'] . "<br>";
        echo "Deaths: " . $item['death'] . "<br>";
        echo "<br>";
    }
} else {
    echo "Failed to fetch data.";
}

?>
