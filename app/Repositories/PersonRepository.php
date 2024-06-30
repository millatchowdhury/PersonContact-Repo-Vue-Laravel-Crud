<?php
namespace App\Repositories;

use App\Models\Contact;
use App\Models\Person;
use App\Repositories\Interfaces\PersonRepositoryInterface;
use Illuminate\Support\Facades\File;

class PersonRepository implements PersonRepositoryInterface{

    public function allPersons(){
       return Person::with('getContact')->get();
    }
    public function storePerson($data){
        $persons_array = $data['persons'][0];

        
        $person = Person::create([
            'name' => $persons_array['name'],
            'address' => $persons_array['address']
        ]);
        if($persons_array['image']){
            $file = $persons_array['image'];
            $fileName = time().".".$file->getClientOriginalExtension();
            $file->move(public_path('/persons'), $fileName);
            $person->image = $fileName;
            $person->save();
        }
        $contact = new Contact();
        //  Contact::create([])  new Data Post korar jonno
        $contact->personId = $person->id;
        $contact->contact = $data['email'];
        $contact->contact_type = "Email";
        $contact->save();
        return;
    }

   
    public function findPerson($id){
        return Person::with('getContact')->get();
    }
    public function updatePerson($data, $id){
        // dd($data);
        $person = Person::find($id);
        $person->name = $data['name'];
        $person->address = $data['address'];
        

        // image calculation 
        // $imageName = '';
        // $deleteOldImage = 'persons/'.$person->image;
        //     if(file_exists($deleteOldImage)){
        //         File::delete($deleteOldImage);
        //     }
            if($data['image']){
                $image = $data['image'];
                $fileName = time().".".$image->getClientOriginalExtension();
                $image->move(public_path('/persons'), $fileName);
                $person->image = $fileName;
            };
        $person->save();

        $contact = Contact::where('personId', $id)->first();
        $contact->contact = $data['email'];
        $contact->save();
        return;

    }
    public function destroyPerson($id){
        $person = Person::find($id);
        $contact = Contact::where('personId', $id)->first();

        if(File::exists('persons/'.$person->image)){
            File::delete('persons/'.$person->image);
        }
        $person->delete();
        $contact->delete();

      return;
    }

 
}




























 // public function storePerson($data){
    //     $persons_array = $data['persons'][0];
    //     $person = Person::create([
    //         'name' => $persons_array['name'],
    //         'address' => $persons_array['address']
    //     ]);
    //     $personImage = $this->imageUpload($persons_array['image']);
    //     $person->image = $personImage;
    //     $person->save();
    //     Contact::create([
    //        'personId' =>$person->id,
    //         'contact' => $data['email'],
    //         'contact_type' => "Email"
    //     ]);
    //     return;
    // }











   //image upload protected file
    // protected function imageUpload($file){
    //    if($file){
            
    //         $fileName = time().".".$file->getClientOriginalExtension();
    //         $file->move(public_path('/persons'), $fileName);
    //         return  $fileName;
    //    }
    // }