@extends('page.pageMain')
@section('title','Member')
@section('body')
<section class="section">
    <h1 class="title">Football Player</h1>
    <div class="block-user">
        <div class="title-block">
            <h1 class="font-block">Player</h1>
            <div class="for-coach" id="forCoach">
                <h5 class="has-text-white"> For Coach </h5>
                <a href="">
                    <i class="material-icons" style="font-size:40px;color:#FFF">edit</i>
                </a>
                <a href="add">
                    <i class="material-icons" style="font-size:40px;color:#FFF">person_add</i>
                </a>
            </div>
        </div>
        <section class="section">
            <div class="table-block">
                <table class="table is-fullwidth">
                    <thead style=" background: #090255;">
                        <tr>
                            <th class="has-text-white-bis text-center">Number</th>
                            <th class="has-text-white-bis">Profile</th>
                            <th class="has-text-white-bis">Position</th>
                            <th class="has-text-white-bis">Contact</th>
                            <th class="has-text-white-bis">Status</th>
                            <th class="has-text-white-bis">Details</th>
                            <!-- <th class="has-text-white-bis">Edit</th> -->
                        </tr>
                    </thead>
                    <tbody style="background-color: #E4E9F7;">
                    @foreach ($list as $item)
                        <tr>
                            <th style="font-size: 48px;" class="text-center">{{ $item->number }}</th>
                            <td>
                                <div class="columns">
                                    <div class="column">
                                        <div class="profile-column">
                                            <img src="assets/img/{{ $item->photo }}" alt="" class="img-avatar">
                                            <p>{{ $item->name }} <br>[ {{ $item->nickname }} ]</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><p>{{ $item->position }}</p></td>
                            <td>
                                <i class="fab fa-line" style='font-size:24px; color:green;'></i>
                                <i class='fab fa-facebook-square' style='font-size:24px; color:blue;'></i>
                                <i class='fab fa-instagram' style='font-size:24px; color:red;'></i>
                            </td>
                            <td><span class="tag is-success">Ready</span></td>
                            <td></td>
                            <!-- <td><i class='fas fa-user-edit' style='font-size:24px; color:#090255;'></i></td> -->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</section>


@stop