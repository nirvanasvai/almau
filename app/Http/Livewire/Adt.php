<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Livewire\Component;

use App\Models\Adt as Adt_model;
use Livewire\WithFileUploads;

class Adt extends Component
{
    use WithFileUploads;
    //create
    public $title,$description,$adt_id,$price,$images = [];
    //filter
    public $search,$price_filter,$paginate = 10,$created_at,$orderBy=null;


    public function render()
    {
        $search = '%'.$this->search;

        $adts = Adt_model::query();
        if ($this->orderBy == 2) {
            $adts->orderBy('title','desc');
        }if ($this->orderBy) {
            $adts->orderBy('title');
        }
        if ($this->price_filter==1) {
            $adts->orderBy('price','desc');
        }
        if ($this->price_filter) {

            $adts->orderBy('price');
        }
        if ($this->created_at==1) {
            $adts->orderBy('created_at','desc');
        }
        if ($this->search) {
            $adts->where('title', 'LIKE', $search);
        }
//        if( !empty($this->min_price) && !empty($this->max_price)){
//            $adts->whereBetween('price', [(int)$this->min_price, (int)$this->max_price]);
//        }elseif (!empty($this->min_price)){
//            $adts->whereBetween('price', [(int)$this->min_price, 100000000000]);
//        }elseif (!empty($this->max_price)){
//            $adts->whereBetween('price', [0, (int)$this->max_price]);
//        }
        $adts= $adts->paginate($this->paginate);
        return view('livewire.adt',compact('adts'));
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|max:200',
            'price' => 'required|integer',
            'description' => 'required|max:1000',
            'images.*' => 'image|max:1024',
        ]);

        // Update or Insert Post
        $post = Adt_model::updateOrCreate(['id' => $this->adt_id], [
            'title' => $this->title,
            'description' => $this->description,
            'price'=>$this->price
        ]);

        // Image upload and store name in db
        if (count($this->images) > 0) {
            Image::where('adt_id', $post->id)->delete();
            $counter = 0;
            foreach ($this->images as $photo) {

                $storedImage = $photo->store('public/images');

                $featured = false;
                if($counter == 0 ){
                    $featured = true;
                }
                Image::create([
                    'url' =>$storedImage ,
                    'adt_id' => $post->id,
                    'slug_main_image' => $featured
                ]);
                $counter++;
            }
        }


        session()->flash(
            'message',
            $this->adt_id ? 'Объявление успешно обновлено
.' : 'Объявление успешно создано!
'
        );

        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->title = null;
        $this->description = null;
        $this->images = null;
    }


}
