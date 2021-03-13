<?php

namespace App\Http\Livewire;
use App\Message;
use Livewire\Component;

class Counter extends Component
{
	
	protected $listeners = ['refreshCount'];
	// public function increment(){
	// 	$this->count++;
	// }
	// public  function decrement(){
	// 	$this->count--;
	// }
	public function refreshCount(){

	}
    public function render()
    {	
		$count = Message::all()->count();
        return view('livewire.counter', ['count' => $count]);
    }
}
