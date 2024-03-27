<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Create extends Component

{
    use WithFileUploads;

    
    public $message;
    public $validated;
    public $form_id;
    public $announcement;
    

    #[Validate('required' , message: 'Il titolo è richiesto')]
    public $title;

    #[Validate('min:3' , message: 'Il testo è troppo corto')]
    public $body;

    public $images = [];
    
    #[Validate('required' , message: 'Inserisci un numero')]
    #[Validate('numeric' , message: 'Il campo richiede un numero')]
    public $price;

    #[Validate('required' , message: 'Il campo richiede un numero')]
    public $category;

    // #[Validate('required' , message: 'L\'immagine è richiesta')]
    #[Validate('max:1024' , message: 'L\'immagine è troppo grande')]
    public $temporary_images;
    


    
  
    
    

    // public function save(){
    //     $this->validate();
    //     Article::create([
    //         'title' => $this->title,
    //         'subtitle' => $this->subtitle,
    //         'body' => $this->body,
    //     ]);

    //     $this->reset();
    // }
    public function updatedTemporaryImages(){
        if($this->validate([
            'temporary_images.*'=>'image|max:1024',
        ]))
        {
            foreach($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key){
        if(in_array($key, array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    public function store()
    {
        $this->validate();

        $announcement = Category::find($this->category)->announcements()->create([
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            
        ]);

        if(count($this->images)){
            foreach($this->images as $image){
               
                    
                    $newFileName = "announcements/{$announcement->id}";
                    $newImage = $announcement->images()->create(['path'=>$image->store($newFileName , 'public')]);

                    RemoveFaces::withChain([
                        new ResizeImage($newImage->path, 400, 300),
                        new GoogleVisionSafeSearch(($newImage->id)),
                        new GoogleVisionLabelImage(($newImage->id)),
                    ])->dispatch($newImage->id);
                  
            
            }
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        
        


        

    
        session()->flash('message' , 'Annuncio inserito con successo');
        $this->reset();


        
    }
   
    
        
   


    public function render()
    {
        return view('livewire.create');
    }
}
