<?php
include '../includes/session.php';

if (isset($_POST['yes'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE orders SET orders_accept=:status WHERE orders_id=:id");
			$stmt->execute(['status' => 1, 'id' => $id]);
			$_SESSION['success'] = 'Order Accept Successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
}

if (isset($_POST['no'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE orders SET orders_accept=:status WHERE orders_id=:id");
			$stmt->execute(['status' => 2, 'id' => $id]);
			$_SESSION['error'] = 'Order Not Accepted.';
			$stmt = $conn->prepare("UPDATE orders SET orders_accept=:status WHERE orders_id=:id");
			$stmt->execute(['status' => 2, 'id' => $id]);
			$stmt1 = $conn->prepare("SELECT orders.orders_id,orders.orders_qty, orders.orders_address_id, orders.orders_items, orders.orders_cost, address_details.phone 
		   FROM orders INNER JOIN address_details ON address_details.address_id = orders.orders_address_id 
		   WHERE orders.orders_id = :id");
			$stmt1->execute(['id' => $id]);
			foreach ($stmt1 as $row1) {
				$orders_id = $id;
				$orders_address_id = $row1['orders_address_id'];
				$orders_items = $row1['orders_items'];
				$items_cost = $row1['orders_qty'] * $row1['orders_cost'];
				$phone = $row1['phone'];
				$stmt2 = $conn->prepare("INSERT INTO refund (Order_id, address_id, cost, item_name_qty, Mobile_number) 
                        VALUES (:Order_id,:orders_address_id, :cost, :item_name_qty, :Mobile_number)");
				$stmt2->execute(['Order_id' => $id, 'orders_address_id' => $orders_address_id, 'cost' => $items_cost, 'item_name_qty' => $orders_items, 'Mobile_number' => $phone]);
			}

		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
}

header('location: orders.php');
