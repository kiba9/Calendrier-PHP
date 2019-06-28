<?php

namespace App\Date;
mb_internal_encoding('UTF-8');
class  Month{

    public $days =['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private $months=['janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aôut', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
    private $month;
    private $year;

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @param int $month
     * @return Month
     */
    public function setMonth(int $month): Month
    {
        $this->month = $month;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int|null $year
     * @return Month
     */
    public function setYear(?int $year): Month
    {
        $this->year = $year;
        return $this;
    }

    /**
     * Month constructor.
     * @param int $month le mois compris entre 1 et 12
     * @param int $year l'année
     * @throws \Exception
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if($month === null || $month < 1 || $month >12) $month = idate('m');
        if($year === null) $year = idate('Y');
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * renvoie le preùier jour du mois
     * @return \DateTimeInterface
     */
    public function getStartingDay(): \DateTimeInterface{
        return new \DateTimeImmutable("{$this->year}-{$this->month}-01");
    }

    /**
     * @return string retourne le mois en toute lettre (ex: janvier 2018)
     */
    public function toString():string
    {
       return  $this->months[$this->month - 1]." ".$this->year;
    }

    /**
     * renvoie le nombre de semaine que compte un mois particulier
     * @return int
     */
    public function getWeeks(): int {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $startWeek = (int)$start->format('W');
        $endtWeek = (int)$end->format('W');
        if($endtWeek === 1 ){
            $endtWeek =(int)((clone $end)->modify('-7 days')->format('W')) + 1;
        }
        $weeks = $endtWeek-$startWeek + 1;
        if($weeks < 0){
            $weeks = (int)$end->format('W');
        }
        return $weeks;
    }

    /**
     * est-ce que le jour est dans le mois ?
     * @param \DateTimeImmutable $date
     * @return bool
     */
    public function withinMonth(\DateTimeImmutable $date): bool{
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    /**renvoie le mois suivant
     * @return Month
     * @throws \Exception
     */
    public function nextMonth():Month{
        $month = $this->month + 1;
        $year = $this->year;
        if($month > 12){
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }

    /**renvoie le mois precedent
     * @return Month
     * @throws \Exception
     */
    public function prevMonth():Month{
        $month = $this->month - 1;
        $year = $this->year;
        if($month < 1){
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }

}