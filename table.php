<?php
echo "<h3>Наявні кошти банкомату:<br></h3>";
function printTable($data) {
    echo <<<EOL
<table>
    <tr>
        <th>[Номінал]</th>
        <th>[Кількість]</th>
    </tr>
EOL;

    foreach ($data as $key => $value) {
        echo "<tr>";
        echo "<td>$key</td>";
        echo "<td>$value</td>";
        echo "</tr>";
    }
    echo "</table>";
}