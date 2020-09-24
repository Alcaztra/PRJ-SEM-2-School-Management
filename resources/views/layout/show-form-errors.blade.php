@if ($errors->any())
    <div class="p-3 alert-danger">
        @foreach ($errors->all() as $e)
            <p class="text-danger">* {{ $e }}</p>
        @endforeach
    </div>
@endif
