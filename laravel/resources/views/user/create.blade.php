@extends('user.firstLook')
@section('title','Register')
@section('body')
<form method="post" class="form-signin" id="formRegister" action="{{ route('custom.register') }}">
    @csrf
    <h1 class="is-size-3 has-text-weight-bold mb-6 text-center">Register</h1>
    <div class="results">
        @if(Session::get('success'))
            <div class="notification is-info">
                {{ Session::get('success')}}
            </div>
        @endif

        @if(Session::get('fail'))
            <div class="notification is-danger">
                {{ Session::get('fail')}}
            </div>
        @endif
    </div>

    <!-- <a href = "homepage.php" class="text-center"><img class="mb-4" src="assets/logo.png" alt="" width="90" height="90"></a><br><br> -->

    <div class="container">
        <div class="field">
            <label class="label">ID</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="text" placeholder="ID" name="username" value="{{ old('username') }}">
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                </span>
                <span class="icon is-small is-right">
                    <i class="fas fa-check"></i>
                </span>
            </div>
            <span class="has-text-danger">@error('username'){{ $message }} @enderror</span>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control has-icons-left">
                <input class="input" type="password" placeholder="Password" name="password" value="{{ old('password') }}">
                <span class=" icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </div>
            <span class="has-text-danger">@error('password'){{ $message }} @enderror</span>
        </div>

        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
            </div>
            <span class=" has-text-danger">@error('name'){{ $message }} @enderror</span>
        </div>
    </div>

    <div class="field mt-4">
        <label class="label">Position</label>
        <div class="control has-icons-left">
            <div class="select">
                <select name="type">
                    <option selected>Player</option>
                    <option>Coach</option>
                    <option>Admin</option>
                </select>
            </div>
            <div class="icon is-small is-left">
                <i class="fas fa-futbol"></i>
            </div>
        </div>
    </div>

    <div class="field is-grouped mt-6">
        <div class="control">
            <button class="button has-background-info-dark">
                <p class="has-text-primary-light">Submit</p>
            </button>
        </div>
        <div class="control">
            <button class="button is-link is-light" onclick="clearForm()">Clear</button>
        </div>
        <div class="control">
            <a class="button is-danger" href="logout">Logout</a>
        </div>
    </div>
    </div>
</form>
@stop

@section('scripts')
<script>
    function clearForm() {
        document.getElementById("formRegister").reset();
    }
</script>
@stop