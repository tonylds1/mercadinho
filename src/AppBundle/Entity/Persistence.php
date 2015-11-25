<?php
namespace AppBundle\Entity;

interface Persistence
{
    public function create(Persistable $persistable);
    public function research(Persistable $persistable);
    public function update(Persistable $persistable);
    public function delete(Persistable $persistable);
}
