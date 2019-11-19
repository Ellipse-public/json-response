<?php
echo "
<!DOCTYPE html>
<html lang=\"fr\">
<head>
	<meta charset=\"utf-8\" />
	<title>Création du package json-response</title>
	<style>
		* { font-family: Arial,Verdana,Helvetica; }
		body { margin: 0px 5%; }
		h1 { text-align: center; margin-bottom: 30px; }
		div.code { border-left: 5px solid #999999; border-radius: 5px; background-color: #dddddd; padding: 20px; margin-bottom: 15px; font-family: Consolas,'courier new'; }
		a.ret-menu { display: table; margin: 20px auto; background-color: rgb(0, 105, 217); color: white; padding: 15px; text-decoration: none; border-radius: 5px; }
		a.ret-menu:hover { background-color: rgb(0, 123, 255); }
		span.spacer1 { margin-left: 30px; }
		span.spacer2 { margin-left: 60px; }
		span.spacer3 { margin-left: 90px; }
		span.spacer4 { margin-left: 120px; }
		span.hlight { background-color: yellow; font-family: Consolas,'courier new'; }
	</style>
</head>
<body>
<h1>Création du package json-response</h1>
<h2>la classe JsonResponse permet de convertir un tableau en objet json et de gérer le code retour HTTP</h2>";

echo "<h3>Fichier composer.json</h3>
<div class=\"code\">
{<br />
<span class=\"spacer1\"></span>\"name\": \"ellipse-online/json-response\",<br />
<span class=\"spacer1\"></span>\"description\": \"A simple class that returns a properly formatted json response with HYTP status\",<br />
<span class=\"spacer1\"></span>\"keywords\": [\"Json\", \"Response\", \"API Response Class\", \"PHP\"],<br />
<span class=\"spacer1\"></span>\"type\": \"library\",<br />
<span class=\"spacer1\"></span>\"license\": \"MIT\",<br />
<span class=\"spacer1\"></span>\"authors\": [<br />
<span class=\"spacer2\"></span>{<br />
<span class=\"spacer3\"></span>\"name\": \"Ellipse-online\",<br />
<span class=\"spacer3\"></span>\"email\": \"notification@ellipse-online.com\",<br />
<span class=\"spacer3\"></span>\"homepage\": \"http://www.ellipse-online.com\"<br />
<span class=\"spacer2\"></span>}<br />
<span class=\"spacer1\"></span>],<br />
<span class=\"spacer1\"></span><br />
<span class=\"spacer1\"></span>\"require\": {<br />
<span class=\"spacer1\"></span>\"php\": \">=5.3.0\"<br />
<span class=\"spacer1\"></span>},<br />
    <br />
<span class=\"spacer1\"></span>\"autoload\": {<br />
<span class=\"spacer2\"></span>\"psr-4\": {<br />
<span class=\"spacer3\"></span>\"EllipseOnline\\ResponseClass\\\": \"src/\"<br />
<span class=\"spacer2\"></span>}<br />
<span class=\"spacer1\"></span>}<br />
}<br />
</div>";

echo "<h3>Code de la classe (src/JasonResponse.php)</h3>
<div class=\"code\">
<?php
namespace EllipseOnline\ResponseClass;

class JsonResponse
namespace EllipseOnline\ResponseClass;<br />
<br />
class JsonResponse<br />
{<br />
<span class=\"spacer1\"></span>public \$status;<br />
<span class=\"spacer1\"></span>public \$message;<br />
<span class=\"spacer1\"></span>public \$data = [];<br />
<span class=\"spacer1\"></span>public \$statusCode;<br />
<span class=\"spacer1\"></span>public \$result;<br />
    <br />
<span class=\"spacer1\"></span>public function __construct(\$status, \$message = '', array \$data = [])<br />
<span class=\"spacer1\"></span>{<br />
<span class=\"spacer2\"></span>\$this->status = \$status;<br />
<span class=\"spacer2\"></span>\$this->message = \$message;<br />
<span class=\"spacer2\"></span>\$this->data = \$data;<br />
        <br />
<span class=\"spacer2\"></span>\$this->result = array(<br />
<span class=\"spacer3\"></span>'status' => \$this->status<br />
<span class=\"spacer2\"></span>);<br />
        <br />
<span class=\"spacer2\"></span>echo \$this->response();<br />
<span class=\"spacer1\"></span>}<br />
    <br />
<span class=\"spacer1\"></span>/**<br />
<span class=\"spacer1\"></span>* Formatage du message utilisateur avec code statut HTTP<br />
<span class=\"spacer1\"></span>*<br />
<span class=\"spacer1\"></span>* @return string, json object<br />
<span class=\"spacer1\"></span>*/<br />
<span class=\"spacer1\"></span>public function response()<br />
<span class=\"spacer1\"></span>{<br />
<span class=\"spacer2\"></span>\$statusCode = 200;<br />
        <br />
<span class=\"spacer2\"></span>// Code statut HTTP<br />
<span class=\"spacer2\"></span>switch (\$this->status)<br />
<span class=\"spacer2\"></span>{<br />
<span class=\"spacer3\"></span>case 'unauthorized':<br />
<span class=\"spacer4\"></span>\$statusCode = 401;<br />
<span class=\"spacer4\"></span>break;<br />
<span class=\"spacer3\"></span>case 'exception':<br />
<span class=\"spacer4\"></span>\$statusCode = 500;<br />
<span class=\"spacer4\"></span>break;<br />
<span class=\"spacer2\"></span>}<br />
        <br />
<span class=\"spacer2\"></span>// Header pour data json<br />
<span class=\"spacer2\"></span>header('Content-Type', 'application/json');<br />
<span class=\"spacer2\"></span>header(sprintf('HTTP/1.1 %s %s', \$statusCode, \$this->status), true, \$statusCode);<br />
        <br />
<span class=\"spacer2\"></span>if ( \$this->message != '')<br />
<span class=\"spacer2\"></span>{<br />
<span class=\"spacer3\"></span>\$this->result['message'] = \$this->message;<br />
<span class=\"spacer2\"></span>}<br />
        <br />
<span class=\"spacer2\"></span>if ( count(\$this->data) > 0 ) {<br />
<span class=\"spacer3\"></span>\$this->result['data'] = \$this->data;<br />
<span class=\"spacer2\"></span>}<br />
        <br />
<span class=\"spacer2\"></span>return json_encode(\$this->result);<br />
<span class=\"spacer1\"></span>}<br />
}<br />
</div>";

echo "<h3>Code de test de la classe (fichier test.php)</h3>
<div class=\"code\">
&lt;?php<br />
require_once __DIR__.\"/vendor/autoload.php\";<br />
<br />
Use EllipseOnline\ResponseClass\JsonResponse;<br />
<br />
\$student = array(<br />
	'name' => 'John Doe',<br />
	'course' => 'Software Engineering',<br />
	'level' => '200',<br />
	'collections' => ['books' => 'Intro to UML', 'music' => 'rap']<br />
);<br />
<br />
new jsonResponse('ok','',\$student)<br />
?></div>";

echo "<h3>Résultat - Sortie</h3>";

echo "<a href=\"test.php\" class=\"ret-menu\" style=\"margin-left: 0px;\" target=\"_blank\">Tester (appel fichier test.php)</a>";


echo "
<a href=\"..\" class=\"ret-menu\">Retour Menu</a>
</body>
</html>
";
?>