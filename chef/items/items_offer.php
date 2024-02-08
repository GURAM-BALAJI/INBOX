<?php
include '../includes/session.php';

if (isset($_POST['addoffer'])) {
	$id = test_input($_POST['id']);
	$offer = test_input($_POST['offer']);
	$stmt = $conn->prepare("SELECT category_commission FROM category left join items on category_id=item_meal_type WHERE items_id=:items_id");
	$stmt->execute(['items_id' => $id]);
	foreach ($stmt as $row)
		$item_commission_cost = $offer + (($row['category_commission'] / 100) * $offer);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE items SET item_commission_cost=:item_commission_cost,items_cost=:items_cost WHERE items_id=:id");
			$stmt->execute(['item_commission_cost' => $item_commission_cost, 'items_cost' => $offer, 'id' => $id]);
			$_SESSION['success'] = 'Item cost updated successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select item to cost first';
}

header('location: items.php');
