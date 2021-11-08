@extends('page.pageMain')
@section('title','Rival')
@section('body')
<section class="section">
    <h1 class="title">Rival</h1>
    <div class="block-user p-5">
        <div class="title-block">
            
            <div class="row">
                <div class="col-10">
                    <h1 class="font-block">Team</h1>
                </div>
                <div class="col-2 text-center">
                    <h1 class="font-block">For coach</h1>
                    <p><a href="">ADD</a> | <a href="">EDIT</a> </p>
                </div>
            </div>
        </div>
        <section class="section">
            @foreach ($list as $item)
            <div class="card">
                <img src="assets/{{ $item->photo_rival }}" alt="Avatar" style="width:100%">
                <div class="container">
                    <a href="rivalmember?id_rival={{ $item->id_rival }}">
                        <h4><b>{{ $item->name_rival }}</b></h4>
                    </a>
                    <p>Team</p>
                </div>
            </div>
            @endforeach
        </section>

    </div>
</section>
@stop