<?php
require '../src/bootstrap.php';
$pdo = getConnexion();
$events = new \App\Date\Events($pdo);
$errors = [];
try {
    $event = $events->find($_GET['id'] ?? null);
}catch(\Exception $e){
    e404();
}catch(\Error $e){
    e404();
}
$data = [
    'name' => $event->getName(),
    'date' => $event->getStart()->format('Y-m-d'),
    'start' => $event->getStart()->format('H:i'),
    'end' => $event->getStart()->format('H:i'),
    'description' => $event->getDescription()
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $validator = new \App\Date\EventValidator();
    $errors = $validator->validates($data);
    if (empty($errors)) {
        $events->hydrate($event, $data);
        $events->update($event);
        header('Location: index?success=1');
        exit();
    }
}

render ('headers', ['title' => $event->getName()]);
?>
<div class="container">
    <h1>Editer l'évènement <small><?= formantString($event->getName());?></small></h1>

    <form action="" method="post" class="form">
        <?php render('calendar/form', ['data' => $data, 'errors' => $errors]); ?>
        <div class="form-group">
            <button class="btn btn-primary">Modifier l'évènement</button>
        </div>
    </form>
</div>
<?php render('footer');?>
