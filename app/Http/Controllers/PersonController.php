<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Repositories\Interfaces\PersonRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    
    protected $perRepoInter;
    public function __construct(PersonRepositoryInterface $personRepositoryInterface)
    {
        $this->perRepoInter = $personRepositoryInterface;
    }

    public function index(){
        $data = $this->perRepoInter->allPersons();
        return Inertia::render(
            'PersonContact/Index',
            [
                'data' => $data
            ]
        );
    }

    public function create(){
        return Inertia::render(
            'PersonContact/Create'
        );
    }

    public function store(Request $request){
        // dd($request->all());


        $email = [$request->email];
        foreach($email as $e){
            if(filter_var($e, FILTER_VALIDATE_EMAIL)){
                $this->perRepoInter->storePerson($request->all());
                return redirect()->route('person.index')->with('message', 'Person Saved Successfully');
            }else{
                return redirect()->route('person.create')->with('message', 'Envalid Email');
            }
        }
    }

    public function edit($id){
        $personData = $this->perRepoInter->findPerson($id);
        // $personData = Person::find($id);
        return Inertia::render(
            'PersonContact/Edit',
            [
                'personData' => $personData
            ]
        );
    }

    public function update(Request $request, $id){
        $this->perRepoInter->updatePerson($request->all(), $id);
        return redirect()->route('person.index')->with('message', 'person updated successfully');
    }

    public function delete($id){
        $this->perRepoInter->destroyPerson($id);
        return redirect()->route('person.index')->with('message', 'person deleted successfully');
    }
}
