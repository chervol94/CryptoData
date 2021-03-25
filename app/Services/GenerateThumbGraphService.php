<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class GenerateThumbGraphService
{

    /** var OtherService */
    /*private $otherService;

    public function __construct(OtherService $otherService)
    {
        $this->otherService = $otherService;
    }

    public function execute(int $parameter): TestEntity
    {
       $this->otherService->execute();
    }*/

    private $coinGraphData;
    private $finishedGraphData;

    public function setArrayData($coinData){
        $this->coinGraphData = $coinData;
        //dd($this->coinGraphData);
    }

    public function getGraphData(){
        return $this->finishedGraphData;
    }

    public function generateGraph(){
        $graphArray = [];
        foreach ($this->coinGraphData as $id => $value) {
            $maxValue = max($this->coinGraphData[$id]);
            $minValue = min($this->coinGraphData[$id]);

            $img = "<svg width='168' height='50' viewBox='0 0 168 50' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'> <polyline xmlns='http://www.w3.org/2000/svg' points='";
            for ($i=0; $i < count($this->coinGraphData[$id]) ; $i++) { 
                $newPrice = ($this->coinGraphData[$id][$i] - $minValue) / ($minValue - $maxValue);
                $valueTest = abs((abs($newPrice * 50)) - 50); 
                $normalisedPrice[$id][$i] = abs((abs($newPrice * 50)) - 50);
                $img .= " $i,$valueTest ";
            }
            //dd($normalisedPrice[$id]);
            if(reset($normalisedPrice[$id]) < end($normalisedPrice[$id])){
                $color = '#ed5565';
            }else{
                $color = '#57bd0f';
            }
            $img .="' fill='none' stroke='$color' stroke-width='1.25'/></svg>";
            $graphArray[$id] = $img;
            //printf($img);
            //dd(public_path());
            //Storage::putFileAs('a', new File('/public/images/graphs'), 'DATE_ID.jpg');
            //Storage::disk('public') -> putFile('images', new File ('/images'), 'example.txt');
            //echo asset('storage/file.txt');
            $date = date('Ymd',time());
            // TODO Remove the old implementation of the image, via array
            // TODO Move the storage Service to another class
            // TODO implement a system that checks if the image has been saved already, and if the day is another day erases all the old images via another Service, etc 
            // TODO Store in the local the date so the function is not executed continually. erase it every time the user exits the portal and create it every time it acceses 
            Storage::disk('public')->put('/graphs'.'/'."$date".'_'."$id".'.svg', $img, 'public');
        }
        //Storage::disk('public')->put("/graphs/example3.txt", 'Contents');
        
        $this->finishedGraphData = $graphArray;
    }
}
?>