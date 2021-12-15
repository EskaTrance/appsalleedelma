<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div id="reservation_errors" class="alert alert-danger" style="display: none;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <form action="{{ route('reservations.store') }}" method="POST" id="reservation_form" role="form" autocomplete="off" novalidate>
                @csrf
                @include('reservations.form')
            </form>
        </div>
    </div>
</div>
