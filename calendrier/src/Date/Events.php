<?php

namespace App\Date;

mb_internal_encoding('UTF-8');

class Events
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * recupere les evenements entre deux dates
     * @param \DateTimeImmutable $start
     * @param \DateTimeImmutable $end
     * @return array
     */
    public function getEventBetween(\DateTimeImmutable $start, \DateTimeImmutable $end): array
    {

        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY start ASC";
        $statement = $this->pdo->query($sql);
        $result = $statement->fetchAll();
        return $result;
    }

    /**
     * recupere les evenements entre deux dates indexé pae jours
     * @param \DateTimeImmutable $start
     * @param \DateTimeImmutable $end
     * @return array
     */
    public function getEventBetweenByDay(\DateTimeImmutable $start, \DateTimeImmutable $end): array
    {
        $events = $this->getEventBetween($start, $end);
        $days = [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }

    /**
     * recupere un evenement
     * @param int $id
     * @return Evenmt
     * @throws \Exception
     */
    public function find(int $id): Evenmt
    {
        $statement = $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, Evenmt::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception("Aucun résultat n'a été trouvé");
        }
        return $result;
    }

    public function hydrate(Evenmt $event, array $data)
    {

        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(\DateTimeImmutable::createFromFormat('Y-m-d H:i', $data['date'].' '.$data['start'])->format('Y-m-d H:i:s'));
        $event->SetEnd(\DateTimeImmutable::createFromFormat('Y-m-d H:i', $data['date'].' '.$data['end'])->format('Y-m-d H:i:s'));
        return $event;
    }

    /**
     * insert un evenement en base de donnée
     * @param Evenmt $event
     * @return bool
     */
    public function create(Evenmt $event): bool
    {
        $statment = $this->pdo->prepare("INSERT INTO events (name, description, start, end) VALUES (?, ?, ?, ?)");
       return $statment->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * modifie un evenement en base de donnée
     * @param Evenmt $event
     * @return bool
     */
    public function update(Evenmt $event): bool
    {
        $statment = $this->pdo->prepare("UPDATE events SET name = ?, description = ?, start = ?, end = ? WHERE id = ?");
        return $statment->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
            $event->getId()
        ]);
    }

}