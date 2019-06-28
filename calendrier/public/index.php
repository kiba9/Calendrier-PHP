<?php
require '../src/bootstrap.php';
$pdo = getConnexion();
$events = new \App\Date\Events($pdo);
$month = new App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDay();
$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');
$events = $events->getEventBetweenByDay($start, $end);
include '../views/headers.php';
?>

<div class="calendar">

    <?php if(isset($_GET['success'])):?>
    <div class="container">
        <div class="alert alert-success">
            L'évènement a bien été enregistré
        </div>
    </div>
    <?php endif; ?>

    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h1> <?= $month->toString(); ?></h1>
        <div>
            <a href="index.php?month=<?= $month->prevMonth()->getMonth() ?>&year=<?= $month->prevMonth()->getYear() ?>"
               class="btn btn-primary">&lt;</a>
            <a href="index.php?month=<?= $month->nextMonth()->getMonth() ?>&year=<?= $month->nextMonth()->getYear() ?>"
               class="btn btn-primary">&gt;</a>
        </div>
    </div>


    <table class="calendar__table">
        <?php for ($i = 0; $i < $weeks; $i++): ?>
            <tr>
                <?php
                foreach ($month->days as $k => $day):
                    $date = $start->modify("+" . ($k + $i * 7) . "days");
                    $eventForDay = $events[$date->format('Y-m-d')] ?? [];
                    $isToday = date('Y-m-d') === $date->format('Y-m-d');
                    ?>

                    <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth' ?> <?= $isToday ? 'is-today' : '' ?>">
                        <?php if ($i === 0): ?>
                            <div class="calendar__weekday"><?= $day; ?></div>
                        <?php endif; ?>
                        <a href="add.php?date=<?= $date->format('Y-m-d'); ?>" class="calenedar__day"><?= $date->format('d'); ?></a>
                        <?php foreach ($eventForDay as $event): ?>
                            <div class="calendar__event">
                                <?= (new DateTimeImmutable($event['start']))->format('H:i') ?> - <a
                                        href="edit.php?id=<?= $event['id']; ?>"><?= $event['name']; ?></a>
                            </div>
                        <?php endforeach; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>

    </table>

    <a href="add.php" class="calendar__button">+</a>
</div>

<?php include '../views/footer.php'; ?>
