<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;

class Show extends Component
{

                    public $form=[
                            "title"=>"",
                            "body"=>"",
                    ];
    
    public function render()
    {   
                return view('livewire.post.show')
                ->extends('layouts.app');
    }

    public function submit( )
    {
         dd($this->form );
    }
}
