




		<!-- Include the front page -->

		<?php include ('slw-webapp-v1/app-page-templates/selectworks.php');?> 


		$request = $_SERVER['REQUEST_URI'];
$request = trim($request, '/'); // remove leading/trailing slashes

// 2. Define your routes
switch ($request) {
    case '':
    case 'home':
        $page = 'home';
        break;
    case 'vacatures':
        $page = 'vacatures';
        break;
    case 'contact':
        $page = 'contact';
        break;
    default:
        $page = '404';
        break;
}

// 3. Include the right view
include 'partials/header.php';
include "views/$page.php";
include 'partials/footer.php';