@extends('page.pageMain')
@section('title','Add member')
@section('body')
<section class="section">
    <h1 class="title">Add member</h1>
    <div class="block-user">
        <div class="title-block">
            <h1 class="font-block">Form</h1>
        </div>
        <form action="{{ route('player.add') }}" method="post">
            @csrf
            <section class="section">
                <div class="container">
                    @if(Session::get('added'))
                    <div class="notification is-info">
                        {{ Session::get('added')}}
                    </div>
                    @endif

                    @if(Session::get('error'))
                    <div class="notification is-danger">
                        {{ Session::get('error')}}
                    </div>
                    @endif
                    <div class="field">
                        <div class="columns">
                            <div class="column">
                                <label class="label has-text-white	">Name</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="Name" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="column">
                                <label class="label has-text-white	">Nickname</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="Nickname" name="nickname" id="nickname">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-3">
                            <div class="field" >
                                <label class="label has-text-white">Position</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="position" id="position">
                                            <option value="none">Select position</option>
                                            <option value="goalkeeper">Goalkeeper</option>
                                            <option value="defender">Defender</option>
                                            <option value="midfield">Midfield</option>
                                            <option value="forward">Forward</option>
                                        </select>
                                    </div>
                                    <div class="icon is-small is-left">
                                        <i class="fas fa-futbol"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="field">
                                <label class="label has-text-white">Number</label>
                                <div class="control">
                                    <input class="input" type="number" name="number" id="number">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="field">
                                <label class="label has-text-white">Status</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="status">
                                            <option>Ready</option>
                                            <option>Busy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="field">
                                <label class="label has-text-white">Picture</label>
                                <input class="form-control" type="file" name="photo">
                            </div>
                        </div>
                    </div>
                    <div class="field is-grouped mt-6">
                        <div class="control">
                            <button class="button is-link" type="submit">Submit</button>
                        </div>
                        <div class="control">
                            <a href="member" class="button is-link is-light">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</section>
@stop