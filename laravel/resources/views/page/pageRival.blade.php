@extends('page.pageMain')
@section('title','Rival')
@section('modal')
<!-- Modal -->
<div class="modal fade modal-z" id="addTeamRivalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Rival's team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="Text input">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="button is-success" data-bs-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

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
                    <p><a class="addTeamRival">ADD</a> | <a href="">EDIT</a> </p>
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

<script>
    $(document).ready(function() {
        $(document).on('click', '.addTeamRival', function(e) {
            e.preventDefault();
            $('#addTeamRivalModal').modal('show');
        });
    });
</script>
@stop