<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PersonsRepositoryInterface;
use App\Models\Persons;
use App\Models\Contracts;
use File;
class PersonsRepository implements PersonsRepositoryInterface
{
   // create persons
   public function storePerson($data){
      $persons_array = $data['person'][0];
      $person = Persons::create([
        'name'=> $persons_array['name'],
        'address'=>$persons_array['address'],
      ]);
      if($persons_array['avatar']){
         $file = $persons_array['avatar'];
         $filename = time().".".$file->getClientOriginalExtension();
         $file->move(public_path('/persons'),$filename);
         $person->avatar =  $filename;
         $person->save();
      };
      $contract = new Contracts;
      $contract->person_id = $person->id;
      $contract->contract = $data['email'];
      $contract->contract_type = 'Email';
      $contract->save();
      return;
    }

    // get all persons
    public function allPersons(){
      return Persons::with('contracts')->get();
   }

   /// delete person
   public function destroyPersons($id){
      $person = Persons::find($id);
      $contract = Contracts::where('person_id',$id)->first();
      if(File::exists('persons/'.$person->avatar)){
          File::delete('persons/'.$person->avatar);
      };
      $person->delete();
      $contract->delete();
      return;
   }
   // find person
   public function findPersons($id){
      return Persons::find($id)->with('contracts')->get(); 
   }
}
   
  
