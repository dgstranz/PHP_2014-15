<?php

require_once 'conexion.php';

$db_create = 'CREATE DATABASE IF NOT EXISTS ecommerce
        DEFAULT CHARACTER SET utf8
        DEFAULT COLLATE utf8_general_ci';

$create_products = 'CREATE TABLE IF NOT EXISTS ecomm_products (
        product_code  CHAR(5)      NOT NULL,
        name          VARCHAR(100) NOT NULL,
        description   MEDIUMTEXT,
        price         DEC(6,2)     NOT NULL,

        PRIMARY KEY(product_code)
    )';

$create_customers = 'CREATE TABLE IF NOT EXISTS ecomm_customers (
        customer_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        first_name  VARCHAR(20)      NOT NULL,
        address_1   VARCHAR(50)      NOT NULL,
        email       VARCHAR(100)     NOT NULL,

        PRIMARY KEY (customer_id)
    )';

$create_order_details = 'CREATE TABLE IF NOT EXISTS ecomm_order_details (
        order_id     INTEGER UNSIGNED NOT NULL,
        order_qty    INTEGER UNSIGNED NOT NULL,
        product_code CHAR(5)          NOT NULL,

        FOREIGN KEY (product_code) REFERENCES ecomm_products(product_code)
    )';

$create_temp_cart = 'CREATE TABLE IF NOT EXISTS ecomm_temp_cart (
        session      CHAR(50)         NOT NULL,
        product_code CHAR(5)          NOT NULL,
        qty          INTEGER UNSIGNED NOT NULL,

        PRIMARY KEY (session, product_code),
        FOREIGN KEY (product_code) REFERENCES ecomm_products(product_code)
    )';

$insert_products = 'INSERT INTO ecomm_products
        (product_code, name, description, price)
    VALUES
        ("00001",
        "CBA Logo T-shirt",
        "This T-shirt will show off your CBA connection. Our t-shirts are ' .
        'all made of high quality and 100% preshrunk cotton.",
         17.95),
         ("00002",
         "CBA Bumper Sticker", 
         "Let the world know you are a proud supporter of the CBA web site ' .
         'with this colorful bumper sticker.",
         5.95),
         ("00003",
         "CBA Coffee Mug",
         "With the CBA logo looking back at you over your morning cup of ' .
         'coffee, you are sure to have a great start to your day. Our mugs ' .
         'are microwave and dishwasher safe.",
         8.95),
         ("00004",
         "Superhero Body Suit",
         "We have a complete selection of colors and sizes for you to choose ' .
         'from. This body suit is sleek, stylish, and won\'t hinder either ' .
         'your crime-fighting skills or evil scheming abilities. We also ' .
         'offer your choice in monogrammed letter applique.",
         99.95),
         ("00005",
         "Small Grappling Hook",
         "This specialized hook will get you out of the tightest places. ' .
         'Specially designed for portability and stealth, please be aware ' .
         'that this hook does come with a weight limit.",
         139.95),
         ("00006",
         "Large Grappling Hook", 
         "For all your heavy-duty building-to-building swinging needs, this ' .
         'large version of our grappling hook will safely transport you ' .
         'throughout the city. Please be advised however that at 50 pounds ' .
         'this is hardly the hook to use if you are a lightweight.",
         199.95)';

if (!$result = $conn->query($db_create)) {
    echo 'Error al crear la base de datos: ' . $conn->error;
    die();
}


if (!$result = $conn->select_db('ecommerce')) {
    echo 'No se pudo establecer una conexión a la base de datos: ' . mysqli_connect_error();
    die();
}

if (!$result = $conn->set_charset('utf8')) {
    echo 'Error al establecer UTF-8 como juego de caracteres predeterminado: ' . $conn->error;
    die();
}

if (!$result = $conn->query($create_products)) {
    echo 'Error al crear la tabla Products: ' . $conn->error;
    die();
}
if (!$result = $conn->query($create_customers)) {
    echo 'Error al crear la tabla Customers: ' . $conn->error;
    die();
}
if (!$result = $conn->query($create_order_details)) {
    echo 'Error al crear la tabla Order Details: ' . $conn->error;
    die();
}
if (!$result = $conn->query($create_temp_cart)) {
    echo 'Error al crear la tabla Temp Cart: ' . $conn->error;
    die();
}

if (!$result = $conn->query($insert_products)) {
    echo 'Error al insertar los datos: ' . $conn->error;
    die();
}

?>
