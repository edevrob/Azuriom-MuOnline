@extends('admin.layouts.admin')

@section('title', 'Info')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h5>Tolal accounts: <span class="text-primary">{{ $accounts }}</span></h5>
        <h5>Tolal characters: <span class="text-primary">{{ $characters }}</span></h5>     
        <h5>Users online: <span class="text-primary">{{ $online }}</span></h5>
    </div>
</div>
@endsection