<?php
    include('common/connection.php');

	try{
		$page = isset($_POST['product_page']) ? $_POST['product_page'] : 0;

		$limit = 8;
		$idCat = isset($_POST['idCat']) ? $_POST['idCat'] : '';
		if(!empty($idCat)){
			$sql = "SELECT DISTINCT p.ref_product, p.price, p.name, p.image ".
					"FROM products p, product_categories pc ".
					"WHERE p.ref_product=pc.ref_product AND pc.id_category='$idCat'";

			$sqlCount = "SELECT DISTINCT p.ref_product, p.price, p.name, p.image ".
						"FROM products p, product_categories pc ".
						"WHERE p.ref_product=pc.ref_product AND pc.id_category='$idCat'";
		}else{
			$sql = "SELECT * FROM products WHERE 1=1 ";
			$sqlCount = "SELECT * FROM products WHERE 1=1 ";
		}

		$sqlToAdd = isset($_POST['name']) ? " AND name LIKE '%".$_POST['name']."%'" : '';

		$minFilter = isset($_POST['min_price']) && !empty($_POST['min_price']);
		$maxFilter = isset($_POST['max_price']) && !empty($_POST['max_price']);

		$sqlToAdd .= $minFilter ? ' AND price>'.$_POST['min_price'] : '';
		$sqlToAdd .= $maxFilter ? ' AND price<'.$_POST['max_price'] : '';

		$sqlToAdd .= $minFilter || $maxFilter ? ' ORDER BY price ASC ' : '';

		$sql .= $sqlToAdd;
		$sql .= " LIMIT ".$limit." OFFSET ".$page*$limit;
		$stmt = $pdo->query($sql);
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$sqlCount .= $sqlToAdd;
		$stmtCount = $pdo->query($sqlCount);
		$productsCount = $stmtCount->fetchAll(PDO::FETCH_ASSOC);
		
		echo json_encode(array("count" => count($productsCount), "products" => $products));

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch( PDOException $Exception ) {
		echo "Error: " . $Exception->getMessage();
	}
?>