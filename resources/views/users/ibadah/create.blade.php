@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Rencana Ibadah</h2>

    <form action="{{ route('ibadah.store') }}" method="POST">
        @include('users.ibadah._form')
    </form>
</div>
@endsection
