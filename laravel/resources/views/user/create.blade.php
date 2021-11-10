@extends('user.firstLook')
@section('title','Register')
@section('body')
<div class="container">
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
            <div class="field is-grouped mt-5">
                <div class="control">
                    <button class="button is-success" type="submit">
                        <p class="has-text-primary-light">Submit</p>
                    </button>
                </div>
                <div class="control">
                    <a class="button is-danger is-light" href="logout">Logout</a>
                </div>
                <div class="control">
                    <a class="button is-link usersShow">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@stop
<script>
    $(document).ready(function() {
        $(document).on('click', '.usersShow', function(e) {
            e.preventDefault();
            $('#usersModal').modal('show');
        });
    })
</script>
