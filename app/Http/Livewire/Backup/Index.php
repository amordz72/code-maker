<?php

namespace App\Http\Livewire\Backup;

use Livewire\Component;
use App\Http\Requests;
use Artisan;
use Log;
use Storage;use   File;
class Index extends Component
{

    protected $listeners = ['bk_onlyDb' => '$refresh' ];
     
     /* protected $rules = [
     'code' => 'required|min:2',
    ];
    
     $validatedData = $this->validate();
      */
     public $files=array();
     public $index=0 ;
    
 
    
    public function render()
    {
 
        return view('livewire.backup.index') ->extends('layouts.app');
    }


public function create(){

try {
// start the backup process

Artisan::call('backup:run');
  $output = Artisan::output();
 
return redirect(Route('backups')) ;
}
catch (Exception $e) {
Flash::error($e->getMessage());
return redirect(Route('backups')) ;
}
}
public function bk_onlyDb(){

try {
// start the backup process

Artisan::call('backup:run --only-db');
  $output = Artisan::output();
 
 

return redirect(Route('backups')) ;
}
catch (Exception $e) {
Flash::error($e->getMessage());
return redirect(Route('backups')) ;
}
}
public function bk_onlyFiles(){

try {
// start the backup process

Artisan::call('backup:run --only-files');
  $output = Artisan::output();
 
return redirect(Route('backups')) ;

}
catch (Exception $e) {
Flash::error($e->getMessage());
return redirect()->back();
}
}

 
 
 
 
public function loadDbFiles()
        {

          $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() ;
        $dir =$storagePath.'\\'. env('APP_NAME');
          
        
          if (is_dir($dir)){
          if ($dh = opendir($dir)){
          while (($file = readdir($dh)) !== false){
            $info = pathinfo($file);

            if ($info["extension"] == "zip") {
 $file_link=$dir."\\". $file;

            array_push( $this-> files,
            array(
              'filename' => $file , 
              'filemtime' => date ("d F Y // H:i:s.",filemtime($file_link ))  ,
              'filesize' => $this->formatBytes(  filesize($file_link) ) ,
              'url' => $dir."\\".$file ,
              
            ));}
              $this-> index++;
            }
               
          }
         
          }
        
          }
  public function mount()
  { 
     
      $this-> loadDbFiles() ;
 // dd($this-> files);
  }
 public  function formatBytes($bytes, $precision = 2) {
   if ($bytes > pow(1024,3)) return round($bytes / pow(1024,3), $precision)." / GB";
   else if ($bytes > pow(1024,2)) return round($bytes / pow(1024,2), $precision)." / MB";
   else if ($bytes > 1024) return round($bytes / 1024, $precision)." / KB";
   else return ($bytes)."/B";
   }
}
 

  