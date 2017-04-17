<?php

$loader = require_once __DIR__.'/../../vendor/autoload.php';
$loader->add('Anagrom\\', array(__DIR__.'/src'));

$dbfile = __DIR__.'/data/anagrom.sqlite';

#error_log('Es geht los...');
$db = Siox\Db::factory(array(
    'driver' => 'dsn',
    'dsn' => "sqlite:$dbfile",
));

$setup = new Anagrom\Setup($db);
$setup->init();

$tables = $setup->getTables();

header('Content-Type: text/html;charset=UTF-8');

$controller = new Anagrom\Controller($setup->getModel());
$controller->handleRequest();

?>
<!doctype html>
<style>
html {
  font-family: Helvetica, sans-serif;
  font-size: 12pt;
}
form {
  display: block;
  border: thin #000 dashed;
  overflow: hidden;
  max-width: 480px;
}

.input-row { position: relative; overflow: hidden; width: 100%; }
.input-row:after { clear: both; }
input, label { margin: 0.5ex 0; }
.dy-te input { width: 66%; position: absolute; left: 32%; bottom: 2px;}
.dy-te label { width: 30%; float: left; }

.dy-te { max-width: 460px; float: left; margin: 10px; }
.dy-ac { max-width: 460px; float: right; margin: 10px; }
.dy-ac input {width: 100%; }

.title { font-weight: bold; font-size: 1.2em; }
.description { text-align: justify; }

.tables { font-size: 75%; white-space: pre; }

</style>
<div class="tables">
<?php foreach ($tables as $table) {
    echo "{$table->getName()}\n";
    echo $db->sql()->countRows($table);
} ?>
</div>

<div class="concept">
<form name="concept" action="?s=add-concept" method="post">
    <div class="dy-te">
    <div class="title">Konzept</div>
    <div class="input-row">
		<label for="concept">Eingabe:</label>
        <input name="concept" type="text" class="uppercase">
    </div>
    <div class="description">
    Ein Konzept ist ein Bezeichner für einen Term,
    um diesen eindeutig zu machen. Wenn es
    den Bezeichner bereits gibt, wird ein Formular
    angezeigt, das helfen soll, die Mehrdeutigkeit aufzulösen.
    </div>
    </div>
    <div class="dy-ac">
    <input type="submit">
    </div>
</form>
</div>

