<?php
require '../src/bootstrap.php';

$data = [
    'date' => $_GET['date'] ?? date('Y-m-d'),
    'start' => date('H:i'),
    'end' => date('H:i')

];
$validator = new \App\App\Validator($data);
if(!$validator->validate('date', 'date')){
    $data['date'] = date('Y-m-d');
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = [];
    $validator = new \App\Date\EventValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        $events = new \App\Date\Events(getConnexion());
        $event = $events->hydrate(new \App\Date\Evenmt(), $data);
        $events->create($event);
        header('Location: index?success=1');
        exit();
    }
}

render('headers', ['title' => 'Ajouter un évènement']);
?>

<div class="container">


    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            Merci de corriger vos erreurs
        </div>
    <?php endif; ?>
    <h1>Ajouter un evenement</h1>
    <form action="" method="post" class="form">
        <?php render('calendar/form', ['data' => $data, 'errors' => $errors]); ?>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l'évènement</button>
        </div>
    </form>

    <?php render('footer'); ?>
