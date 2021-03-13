@extends('layouts.admin_main')

@section('content')
@livewireStyles
<div class="container mt-3">
	<livewire:counter />
	<livewire:comment />
@livewireScripts
</div>
	
		
@endsection