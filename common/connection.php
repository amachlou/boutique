<?php 
    $pdo = new PDO('pgsql:host=db;dbname=boutique','root', 'rootpassword');

    // select categories and counts of it;s products
    /*
     SELECT categories.name, count(product_categories.ref_product) 
     FROM categories, product_categories 
     where categories.id_category = product_categories.id_category 
     group by (categories.id_category)
     */