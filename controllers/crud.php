<?php

require_once '../models/Users.php';

$action = isset($_POST['action']) ? $_POST['action'] : false;

$response = [
	'message' => '',
	'success' => false,
];

switch ($action) {
	case "create-user":


		$user = new  Users;

		foreach ($_POST as $key => $value) {
			if (in_array($key, $user->fields)) {
				$user->{$key} = $value;
			}
		}

		if ($user->save()) {
			$response['success'] = true;
			$response['message'] = 'New user has been added with Id: ' . $user->lastInsertId;
		};

		break;
	default:
		$response['message'] = "URL not found.";
}

echo json_encode($response);