@if ($errors->any())
    <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif
