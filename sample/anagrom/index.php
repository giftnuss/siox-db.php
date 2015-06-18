<?php

require_once __DIR__.'/../../vendor/autoload.php';

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
input {
  float: right;
  margin: 1em;
}
.dy-te { max-width: 460px; float: left; margin: 10px; }
.title { font-weight: bold; font-size: 1.2em; }
.description { text-align: justify; }

.tables { font-size: 75%; white-space: pre; }

</style>
<div class="tables">
<?php foreach ($tables as $table) {
    echo "{$table->getName()}\n";
} ?>
</div>

<div class="concept">
<form name="concept" action="?s=add-concept" method="post">
    <div class="dy-te">
    <div class="title">Konzept</div>
    <div class="description">
    Ein Konzept ist ein Bezeichner für einen Term,
    um diesen eindeutig zu machen. Wenn es
    den Bezeichner bereits gibt, wird ein Formular
    angezeigt, das helfen soll, die Mehrdeutigkeit aufzulösen.
    </div>
    </div>
    <input type="submit">
</form>
</div>

