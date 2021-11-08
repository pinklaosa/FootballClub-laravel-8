@extends('page.pageMain')
@section('title','Add member')
@section('body')
<section class="section">
    <h1 class="title">Add member</h1>
    <div class="block-user">
        <div class="title-block">
            <h1 class="font-block">Form</h1>
        </div>
        <form action="{{ route('added.member') }}" method="post" enctype="multipart/form-data">
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
                                    <input class="input" type="text" placeholder="Name" name="name">
                                </div>
                                <span class="has-text-danger">@error('name'){{ $message }} @enderror</span>
                            </div>
                            <div class="column">
                                <label class="label has-text-white	">Nickname</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="Nickname" name="nickname">
                                </div>
                                <span class="has-text-danger">@error('nickname'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="field mt-5">
                        <label class="label has-text-white">Username</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input is-success" type="text" placeholder="Username" name="username">
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fas fa-check"></i>
                            </span>
                        </div>
                        <span class="has-text-danger">@error('username'){{ $message }} @enderror</span>
                    </div>
                    <div class="field mt-5">
                        <div class="columns">
                            <div class="column is-2">
                                <label class="label has-text-white">Position</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="position">
                                            <option>Select position</option>
                                            <option>โค้ช</option>
                                            <option>กองหน้า</option>
                                            <option>กองกลาง</option>
                                            <option>กองหลัง</option>
                                            <option>ประตู</option>
                                        </select>
                                    </div>
                                    <div class="icon is-small is-left">
                                        <i class="fas fa-futbol"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-1 mr-6">
                                <label class="label has-text-white	">Number</label>
                                <div class="control">
                                    <input class="input" type="number" name="number">
                                </div>
                            </div>
                            <div class="column is-2">
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
                            <div class="column">
                                <label class="label has-text-white">Picture</label>
                                <!-- <div class="file is-info has-name">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="photo" id="photo">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Upload
                                            </span>
                                        </span>
                                        <span class="file-name has-text-white">
                                            Screen Shot 2017-07-29 at 15.54.25.png
                                        </span>
                                    </label>
                                </div> -->
                                <input type="file" name="photo">
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