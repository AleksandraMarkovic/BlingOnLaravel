@if(session()->has('success'))
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            {{ session('success')}}
        </div>
    </div>
@endif
