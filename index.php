

use Controller\RouteController;

require_once "autoloader.php";

require_once "route.php";

header( 'Access-Control-Allow-Origin: *' );
header( 'Content-Type: application/json; charset=UTF-8' );
header( 'Access-Control-Allow-Methods: POST' );
header( 'Content-Type: multipart/form-data; charset=UTF-8' );
header( 'Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With' );

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$requestUrl = parse_url(htmlspecialchars($_SERVER['REQUEST_URI']), PHP_URL_PATH);

$requestMethod = htmlspecialchars($_SERVER['REQUEST_METHOD']);

$route = new RouteController();

$route->match($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);