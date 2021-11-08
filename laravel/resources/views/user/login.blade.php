@extends('user.firstLook')
@section('title','Login')
@section('body')
<form method="post" class="form-signin" action="{{ route('custom.check') }}">
    @csrf
    <div class="text-center">
        <a href="" class="text-center"><img class="mb-4" src="{{ asset('/assets/logo.png') }}" alt="" width="90" height="90"></a><br><br>
    </div>
    <h1 class="is-size-3 has-text-weight-bold mb-6 text-center">IT Football Club</h1>
    <!-- <div class="results">
        @if(Session::get('fail'))
            
        @endif
    </div> -->
    <div class="container px-3">
        <div class="field">
            <p class="control has-icons-left has-icons-right">
                <input class="input" type="text" placeholder="ID" name="username">
                <span class="icon is-small is-left">
                    <i class="fas fa-key"></i>
                </span>
                <span class="icon is-small is-right">
                    <i class="fas fa-check"></i>
                </span>
            </p>
            <span class="has-text-danger">@error('username'){{ $message }} @enderror</span>
        </div>

        <div class="field mt-3">
            <p class="control has-icons-left">
                <input class="input" type="password" placeholder="Password" name="password">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </p>
            <span class="has-text-danger">@error('password'){{ $message }} @enderror</span>
        </div>

        <button type="submit" class="button has-background-info-dark mt-5 is-fullwidth">
            <p class="has-text-primary-light"> Login </p>
        </button>
        <div class="text-center">
            <a href="" class="button is-ghost mt-4"> Contact admin for signup</a>
        </div>
    </div>

</form>
@stop