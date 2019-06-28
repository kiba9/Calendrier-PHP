<?php
require '../src/bootstrap.php';
$pdo = getConnexion();
$events = new \App\Date\Events($pdo);
if(!isset($_GET['id'])){
    header('location: 404.php');
}
try {
    $event = $events->find($_GET['id']);
}catch(\Exception $e){
    e404();
}

render ('headers', ['title' => $event->getName()]);
?>

<h1><?= formantString($event->getName());?></h1>

<ul>
    <li>Date: <?= $event->getStart()->format('d/m/Y'); ?></li>
    <li>Heure de démarrage: <?= $event->getStart()->format('H:i');?></li>
    <li>Heure de fin: <?= $event->getEnd()->format('H:i'); ?></li>
    <li>Description:<br>
        <?= formantString($event->getDescription());?>
    </li>
</ul>

<?php include '../views/footer.php';?>
