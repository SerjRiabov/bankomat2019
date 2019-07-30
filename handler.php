<?php

if (file_exists("data.json")) {
    $handle = fopen('data.json', 'rb');
    $str = fread($handle, filesize('data.json'));
    fclose($handle);
    $data = json_decode($str,true);
}
else {
    $data = [
        '500' => 1000,
        '200' => 1000,
        '100' => 1000,
        '50' => 1000,
        '20' => 1000,
        '10' => 1000,
        '5' => 1000];
}

$sum = $_POST["sum"] ? $_POST["sum"] :0;

$err = '';
    if (filter_var($sum, FILTER_VALIDATE_INT) == false && $suma != '0') {
        $err = $err . "Введіть коректне числове цілочисленне значення суми<br>";
    }
    if (filter_var($sum, FILTER_VALIDATE_INT) == true && ($sum < 5)) {
        $err = $err . "Введене значення менше 5 гривень<br>";
    }
    if (filter_var($sum, FILTER_VALIDATE_INT) == true && ($sum % 5 != 0)) {
        $err = $err . "Введене значення не кратне 5<br>";
    }
    if (filter_var($sum, FILTER_VALIDATE_INT) == true && ( sumATM($data)< $sum)) {
        $err = $err . "Недостатньо купюр у банкоматі<br>";
    }

    if ($err != '') {
        echo "Видача суми <b>$sum </b>неможлива:<br>";
        echo $err;
        echo '<a href="index.php">Повернутися назад</a>';
        die();
    }
    else{
    echo "Сума для зняття: $sum <br>";
    echo "Число купюр: ";
    foreach ($data as $key => $value){
        $remainder =  $sum % $key;
        $amount = ($sum-$remainder)/$key;
        if ($amount <= $data[$key]){
            $data[$key] -= $amount;
            $sum = $sum - $key*$amount;
        }
        if($amount !=0){
            echo "$amount"."х"."$key ";
        }
        $handle = fopen('data.json', 'wb');
        $str = json_encode($data);
        fwrite($handle, $str);
        fclose($handle);
    }
    }

    function sumATM($data){
        foreach ($data as $key => $value) {
            $sumATM +=  $key * $value;
        }
        return $sumATM;
    }
include "table.php";
printTable($data);

?>
<br>
<a href="index.php">Повернутися назад</a>
