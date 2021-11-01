<?php

namespace App\Http\Livewire\Code;

use Livewire\Component;

class Create extends Component
 {       
     
 public $codeType='';
 public $name='';
 public $code='';
 public $showMsg=false;
 public $index=1;
 public $cols=array();
 public $col_name="";
 public $col_type="";
 public $colsDataTypes=array(
 "increments('col')",
 "bigIncrements('col')",
 "mediumIncrements('col')",
 "string('col',255)",
 "decimal('col', 5, 2)",
 "text('col')",
 "integer('votes')",
 "mediumInteger('votes')",
 "boolean('confirmed')",
 "char('col', 100)",
 "decimal('col', 5, 2)",
 "double('col', 8, 2)",
 "enum('col', ['male', 'female'])",
 "float('col', 8, 2)",
 "longText('col')",
 "mediumText('col')",
 "lpAddress('visitor')",
 "macAddress('device')",
 'foreignId("col") ->constrained("tbl2","id")->onDelete(null)',

 );
 public $tableFk="";
 public $null=false;

 protected $listeners = ['make' => 'getCode'];
 protected $rules = [
 'name' => 'required|min:2',

 ];
 public function render()
 {
 return   view('livewire.code.create' )
 ->extends('layouts.app');

 }

 public function addCol()
 {
 if ($this->null=="") {
 $this->null=0;
 }

 array_push( $this-> cols,
 array('id' => $this-> index,"name" => $this->col_name, 'type' =>
 str_replace(['col','tbl2'], [$this->col_name ,$this-> tableFk ],$this->col_type),"null"=>$this->null));
 $this-> index++;
 }
 public function getCode()
 {
 $validatedData = $this->validate();
 $nameLower=strtolower ( $this->name ) ;
 $nameUpperFirst=ucfirst($this->name);

 if ( $this->codeType =="عرض_الكل") {
 $this->code= "
 php artisan make:livewire ". $nameUpperFirst."\\index

 public $". $nameLower."s;
 public function render()
 {
 ".'$'."this->". $nameLower."s = ". $nameUpperFirst."::all();
 return view('livewire.". $nameLower.".index')
 ->extends('layouts.app')
 ->section('content');
 }
 # Route Route

 Route::prefix('". $nameLower."/')->group(function () {
 Route::get('index', \App\Http\Livewire\\". $nameLower."\\index::class)->name('". $nameLower.".index');
 /*Route::get('show/{id}', \App\Http\Livewire\\". $nameLower."\\show::class)->name('". $nameLower.".show');
 Route::get('create', \App\Http\Livewire\\". $nameLower."\\create::class)->name('". $nameLower.".create');
 */Route::get('edit/{id}', \App\Http\Livewire\\". $nameLower."\\edit::class)->name('". $nameLower.".edit');

 });

 //4 Html
 @foreach($". $nameLower."s as $". $nameLower.")

     {{ $". $nameLower."->id }}


 @endforeach
 <button wire:click=\"delete\">Delete ". $nameLower."</button>
 <button wire:click=\"update\">Update ". $nameLower."</button>
 ";

 }
 else if ( $this->codeType =="عرض")
 {
 // dd($nameLower);

 $this->code= "

 //1
 php artisan make:livewire ". $nameUpperFirst."\\show

 //2
 use App\Models\\". $nameUpperFirst.";

 //3
 public $". $nameLower.";

 public function mount("."$"."id)
 {
 "."$"."this->". $nameLower." = ".$nameUpperFirst."::find("."$"."id);
 }

 return view('livewire.". $nameLower.".show')
 ->extends('layouts.app')
 ->section('content');

 # Route Route

 Route::get('show'/{id}, \App\Http\Livewire\\". $nameLower."\\show::class)->name('". $nameLower.".show');

 ";

 }
 else if ( $this->codeType =="الاضافة")
 {
 $this->code= "
 php artisan make:livewire ". $nameUpperFirst."\\create

 use App\Models\\". $nameUpperFirst.";

 public function render()
 {
 return view('livewire.". $nameLower.".create')
 ->extends('layouts.app')
 ->section('content');
 }

 # Route Route

 Route::get('create', \App\Http\Livewire\\". $nameLower."\\show::class)->name('". $nameLower.".create');

 ";
 }

 else if ( $this->codeType =="تعديل")
 {
 $this->code= "
 php artisan make:livewire ". $nameUpperFirst."\\edit

 use App\Models\\". $nameUpperFirst.";

 public function render()
 {
 return view('livewire.". $this->name.".edit')
 ->extends('layouts.app')
 ->section('content');
 }
 public function delete()
 {
 ".'$'."this->". $nameLower."->delete();
 }
 public function update()
 {
 ".'$'."this->". $nameLower."->update();
 }

 # Route Route

 Route::get('edit', \App\Http\Livewire\\". $this->name."\\edit::class)->name('". $this->name.".edit');

 ";
 }
 elseif($this->codeType =="بناء_الجدول"){
 $this->code= "php artisan make:model ". $nameUpperFirst." -mc -r
 php artisan migrate:rollback
 php artisan migrate
 ";

 }
 elseif($this->codeType =="كود_الجدول"){
 $this->code= "Schema::create('tasks', function (Blueprint ".'$'."table) {\r\n";



 foreach ($this->cols as $item) {
 $my_null='';
 if ($item['null']==1) {
 $my_null="->nullable()";
 }
 else{$my_null="";}
 $this->code.= '$'.'table->'. $item['type'] .$my_null. ";\r\n" ;

 }
 $this->code.= '$'."table->timestamps();\r\n});





 ";

 }

 }


 }

