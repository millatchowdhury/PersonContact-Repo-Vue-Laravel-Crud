<?php

namespace App\Http\Controllers;
use App\Repositories\Interfaces\PersonsRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Persons;
use Inertia\Inertia;

class PersonsController extends Controller
{
    protected $personRepository;
    public function __construct(PersonsRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    // get all persons
    public function get__all__persons__method(){
        $persons = $this->personRepository->allPersons();
        return Inertia::render('Persons/GetPersonsPages',['persons'=>$persons]);
    }

    /// create from
    public function create__person__method(){
        return Inertia::render('Persons/CreatePersonPages');
    }

    // create person
    public function create__store__person__method(Request $request){
        $email = [$request->email];
        foreach ($email as $e){
            if (filter_var($e, FILTER_VALIDATE_EMAIL)) {
               $person = $this->personRepository->storePerson($request->all());
               return redirect()->route('person.get.all')->with('success','person create successfully');
            } 
            else {
                return redirect()->route('person.create')->with('success','invalid email');
            }
        
    }
   
}

// delete person
public function delete__person__method($id){
    $this->personRepository->destroyPersons($id);
    return redirect()->route('person.get.all')->with('success','person delete successfully');
}


// edit form
public function edit__person__method($id){
    $person = $this->personRepository->findPersons($id);
    return Inertia::render('Persons/EditPersonPages',['person'=>$person]);  
}
}
