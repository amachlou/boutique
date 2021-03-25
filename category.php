<?php
    include('common/connection.php');
	$cat_offset = isset($_POST['category_page']) ? $_POST['category_page'] : 0;
	$limit = 16;
	// For categories fetch
	$sql = "SELECT categories.id_category cat_id, categories.name, count(product_categories.ref_product) count ".
		   "FROM categories, product_categories ".
		   "WHERE categories.id_category = product_categories.id_category ".
		   "GROUP BY (categories.id_category) ".
		   "ORDER BY count DESC ".
		   "LIMIT ".$limit." OFFSET ".$cat_offset*$limit;

	$stmt = $pdo->query($sql);
	$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	// FetchCount rows
	$sqlCount = "SELECT count(product_categories.ref_product) count ".
		   "FROM categories, product_categories ".
		   "WHERE categories.id_category = product_categories.id_category ".
		   "GROUP BY (categories.id_category) ".
		   "ORDER BY count DESC ";

	$stmtCount = $pdo->query($sqlCount);
	$categoriesCount = $stmtCount->fetchAll(PDO::FETCH_ASSOC);
	
	echo json_encode(array("categories" => $categories, "count" => count($categoriesCount)));
?>