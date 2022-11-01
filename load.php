<?php

require __DIR__.'/vendor/autoload.php';

$conn = mysqli_connect("localhost", "root", "root", "products");

$affectedRow = 0;

$xml = simplexml_load_string(file_get_contents("products.xml")) or die("Error: Cannot create object");

foreach ($xml->children() as $row) {

    $item_id = (int) $row->ITEM_ID;
    $itemgroup_id = (int) $row->ITEMGROUP_ID;
    $product = (string) $row->PRODUCT;
    $categorytext =(string) $row->CATEGORYTEXT;
    $description = (string) $row->DESCRIPTION;
    $url = (string) $row->URL;
    $imgurl =(string) $row->IMGURL;
    $imgurl_alternative = (string) $row->IMGURL_ALTERNATIVE;
    $price_vat = (int) $row->PRICE_VAT;
    $vat = (int) $row->VAT;
    $dues = (int) $row->DUES;
    $delivery_date = (int) $row->DELIVERY_DATE;
    $param_name = (string) $row->PARAM_NAME;
    $param_val = (string) $row->VAL;
    $delivery_id = (string) $row->DELIVERY_ID;
    $delivery_price = (int) $row->DELIVERY_PRICE;
    $delivery_price_cod = (int) $row->DELIVERY_PRICE_COD;
    $manufacturer = (string) $row->MANUFACTURER;

    $sql = "INSERT INTO `produkty`(`item_id`,`itemgroup_id`,`product`,`categorytext`,`description`,`url`,`imgurl`,
                       `imgurl_alternative`,`price_vat`,`vat`,`dues`,`delivery_date`,
                       `param_name`,`param_val`,`delivery_id`,`delivery_price`,`delivery_price_cod`,`manufacturer`)
            VALUES ('" .$item_id. "','". $itemgroup_id. "','" .$product. "','". $categorytext. "','"
        .$description. "','" .$url. "','" .$imgurl. "','" .$imgurl_alternative. "','" .$price_vat. "','" .$vat. "','"
        .$dues. "','" .$delivery_date. "','" .$param_name. "','"
        .$param_val . "','". $delivery_id. "','". $delivery_price. "','". $delivery_price_cod."','". $manufacturer."')";

    $result = mysqli_query($conn, $sql);

    if (! empty($result)) {
        $affectedRow ++;
    } else {
        $error_message = mysqli_error($conn) . "\n";
    }
}
?>
    <h2>Insert XML Data to MySql Table Output</h2>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
} else {
    $message = "No records inserted";
}
?>
