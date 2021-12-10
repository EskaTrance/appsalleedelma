<div id="reservation_errors" class="alert alert-danger" style="display: none;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
<form action="{{ route('reservations.update', ['reservation' => $reservation]) }}" method="POST" id="reservation_form" role="form" autocomplete="off" novalidate>
    @method('PATCH')
    @csrf
    @include('reservations.form')
</form>
@include('reservations.partials.modals')
