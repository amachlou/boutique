<?php
    $pdo = new PDO('mysql:host=localhost;dbname=db_2','root','');

    $jsondata = file_get_contents("produits.json");

    $product_list = json_decode($jsondata,true);
    foreach($product_list as $k=>$product):
        $ref = $product['ref'];
        $name = $product['name'];
        $type = $product['type'];
        $price = $product['price'];
        $shipping = $product['shipping'];
        $manufacturer = $product['manufacturer'];
        $description = $product['description'];
        $image = $product['image'];

        $categories = $product['category'];

        echo 'Insert Product ref: '.$ref.'<br>';
        echo '=> '.$ref.''.$name.''.$type.''.$price.''.$shipping.''.$manufacturer.''.$description.''.$image.'';
        try{
            $sql  = "INSERT INTO products VALUES(?,?,?,?,?,?,?,?)";
            $stmtProd = $pdo->prepare($sql);
            $stmtProd->execute(array($ref, $name, $type, $price, $shipping, $manufacturer, $description, $image));
            $lastProdRef = $pdo->lastInsertId();
        }catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
            echo '===============> Exception in product insert CODE!';
        }

        foreach($categories as $k2=>$category):
            $cat_id = $category['id'];
            $cat_name = $category['name'];
            echo 'Insert Category id: '.$cat_id.'<br>';

            echo 'Cat=> '.$cat_id.'-----'.$cat_name;

            try{// make sure about this category ID
                $sql = "SELECT * FROM categories WHERE id_category=".$cat_id;
                $rows = $pdo->query($sql);
                if(!$rows){
                    $sql  = "INSERT INTO categories VALUES(?, ?)";
                    $stmtCat = $pdo->prepare($sql);
                    $stmtCat->execute(array($cat_id, $cat_name));
                    $lastCatId = $pdo->lastInsertId();
                }
            }catch( PDOException $Exception ) {
                throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                echo '===============> Exception in Category insert CODE!';
            }

            echo 'Insert ProductCategories: '.$cat_id.'<br>';
            try{
                    $sql  = "INSERT INTO product_categories VALUES(?, ?)";
                    $stmtProdCat = $pdo->prepare($sql);
                    $stmtProdCat->execute(array($ref, $cat_id));
            }catch( PDOException $Exception ) {
                throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                echo '===============> Exception in productCategories insert CODE!';
            }
        endforeach;
        
    endforeach;
?>