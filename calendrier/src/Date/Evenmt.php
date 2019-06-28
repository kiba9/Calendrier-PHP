<?php

namespace App\Date;

class Evenmt{

    private $id;
    private $name;
    private $description;
    private $start;
    private $end;

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    /**
     * @return mixed
     */
    public function getStart():\DateTimeImmutable
    {
        return new \DateTimeImmutable($this->start);
    }

    /**
     * @return mixed
     */
    public function getEnd():\DateTimeImmutable
    {
        return new \DateTimeImmutable($this->end);
    }

    /**
     * @param mixed $name
     * @return Evenmt
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $description
     * @return Evenmt
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $start
     * @return Evenmt
     */
    public function setStart(string $start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param mixed $end
     * @return Evenmt
     */
    public function setEnd(string $end)
    {
        $this->end = $end;
        return $this;
    }




}