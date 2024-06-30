<?php
namespace App\Repositories\Interfaces;

Interface PersonRepositoryInterface{

    public function allPersons();
    public function storePerson($data);
    public function findPerson($id);
    public function updatePerson($data, $id);
    public function destroyPerson($id);

}