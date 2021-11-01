<?php

namespace App\Http\Livewire\Code;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Code;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
  
public $CodeLocation="Choose...";
   public $form=[
                    "title"=>"",
                    "code"=>"",
                    "notes"=>"",
                    "user_id"=>1,
                    ];
                   public $count=0; 
                   public $isNew=true ;
                   public $hidenId =0;
                   public $confirmed =false;

public function render()
    {
        $all=Code::all();
        $code_pg=Code::paginate(5);

        $this->count=count($all);

            return view('livewire.code.index',['codes'=>$code_pg])
            ->extends('layouts.app');
    }
public function submit()
    {
         if (trim( $this->form['title'])=='') {
       $this->flash('ادخل العنوان اولا') ;
      return;
    }
        $this->form['user_id']=Auth::id();
        Code::create($this->form);
           $this->clear() ;
    }
public function  show  (  $item )
    {
        $this->form['title']=$item['title'];
        $this->form['code']=$item['code'];
        $this->form['notes']=$item['notes'];
         $this->hidenId=$item['id'];
        $this->isNew=false;
    }
public function  update  (  )
    {
  
            $report= Code::find( $this->  hidenId );
            
            $report->title = $this->form['title'];
            $report->code = $this->form['code'];
            $report->notes = $this->form['notes'];
            
            $report->save();
            $this->clear() ;
    }
public function  destroy  ($id)
    {
        $this->form['user_id']=Auth::id();
        
          Code:: find($id)->delete();
 

            $this->clear() ;

    } 
public function clear()
    {
         $this->form['title']='';
         $this->form['code']='';
         $this->form['notes']='';
         $this->hidenId=0;
    $this->isNew=true;
    
    } public function flash($msg)
    {
    session()->flash('message', $msg);
    }

   
}
