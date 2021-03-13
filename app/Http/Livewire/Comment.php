<?php

namespace App\Http\Livewire;
use Carbon\Carbon;
use App\Message;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
 	
 	use WithPagination;
 	protected $paginationTheme = 'bootstrap';
    public $newMessage;
    public $editmessage;
	// public $allmessages;

	protected $rules = [
        'newMessage' => 'required|max:100',
        
    ];
    protected $messages = [
        'newMessage.required' => 'không để trống',
        'newMessage.max' => 'Quá số từ',
    ];

    public function change($id){
        $message = Message::find($id);
        $message->content = $this->editmessage;
        $message->save();
        $this->dispatchBrowserEvent('closeModal');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function remove($id){
    	$message = Message::find($id);
    	$message->delete();
    	// $this->allmessages = $this->allmessages->where('id','!=',$id);
        session()->flash('alert', 'Xoá thành công');
        $this->emit('refreshCount');
    }

	public function addMessage(){
		$this->validate();
		$message_added = Message::create(['content' => $this->newMessage]);
		// $this->allmessages->prepend($message_added);
        $this->newMessage = '';
        $this->emit('refreshCount');
        
	}

	// public function mount(){
    	
 //    	 $messages = Message::latest()->get();
 //    	 $this->allmessages = $messages; 
 //    }

    public function render()
    {		   		
        return view('livewire.comment',['allmessages' => Message::latest()->paginate(5),]);
    }

    
}
