<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class GraphStorageManagerService{

    private $date;

    public function setDate(){
        $this->date = date('Ymd',time());
    }

    // DONE implement a system that checks if the image has been saved already, and if the day is another day erases all the old images via another Service, etc 
    public function storeGraph($img,$coinId){

        if(empty($this->date)){
            $this->setDate();
            Storage::disk('public')->put('/graphs'.'/'."$this->date".'_'."$coinId".'.svg', $img, 'public');
        }else{
            Storage::disk('public')->put('/graphs'.'/'."$this->date".'_'."$coinId".'.svg', $img, 'public');
        }

    }

    public function checkLastStored(){
        //dd(Storage::disk('public')->files('/graphs'));
        $actualFiles = Storage::disk('public')->files('/graphs');
        $fileName = array_shift($actualFiles);
        $dateStored = strtok(substr($fileName, strpos($fileName, "/") + 1), '_');
        //$dataStored2 = strtok($dataStored, '_');
        //dd($dataStored);
        if ($this->date != $dateStored){
            //die("The date is different");
            $this->deleteCurrentFiles($dateStored);
            //return true;
        }else{
            //die("The date is the same");
            //return false;
        }
    }

    private function deleteCurrentFiles($dateOnFile){
        Storage::disk('public')->deleteDirectory('graphs');
    }
}



?>