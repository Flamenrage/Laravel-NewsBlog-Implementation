    @if(session('success')) {{-- Session без доллара --}}
        <div class="alert alert-success">
            {{session('success') }}
        </div>
    @endif

    @if(session('error')) {{-- Session без доллара --}}
    <div class="alert alert-danger">
        {{session('error') }}
    </div>
    @endif

    <div class="mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
