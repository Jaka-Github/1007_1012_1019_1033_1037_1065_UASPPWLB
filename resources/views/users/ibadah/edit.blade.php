@extends('layouts.users')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Rencana Ibadah</h2>

    <form action="{{ route('ibadah.update', $plan->id) }}" method="POST">
        @include('users.ibadah._form', ['isEdit' => true])
    </form>
</div>
@endsection
