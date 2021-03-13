<div>
    @if(session()->has('alert'))
        <div class="alert alert-success text-center">
                      {{ session('alert') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>   
    @endif
    @error('newMessage') <span class="text-danger">{{ $message }}</span> @enderror
    <form wire:submit.prevent="addMessage">
        <input type="text" wire:model="newMessage">
        <input type="submit">
    </form>
    <div>
    	<hr>
    	@foreach($allmessages as $index => $message)
    		<h5>{{$message->content}}</h5>
            <p>{{ $message->created_at->diffForHumans() }}</p>
            <i class="fas fa-times text-danger" wire:click="remove({{$message->id}})"></i>
            {{-- <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{$index}}">
                    Edit
            </button> --}}
            <div class="modal fade" id="exampleModal{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <input type="text" placeholder="{{$message->content}}" class="form-control" wire:model.lazy="editmessage">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click="change({{$message->id}})">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            <hr>
    	@endforeach
        {{ $allmessages->links() }}
    </div>
</div>
