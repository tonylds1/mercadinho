<?php
namespace AppBundle\Entity;

interface Persistable
{
    public function getDataToPersist();
    public function setId($id);
    public function getId();
}
