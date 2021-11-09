@extends('page.pageMain')
@section('title','Rival')
@section('modal')
<!-- Modal -->
<div class="modal fade modal-z" id="addTeamRivalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('rival.addteam') }}" method="post" id="formAddRival">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Rival's team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="field">
                                <label class="label">Name</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="Team Name" name="rivalteam_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label">Logo team</label>
                            <input class="form-control" type="file" id="formFile" name="photo_rival">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="button is-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
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
        <section class="section" id="rival_team">
            <div class="row"></div>
        </section>

    </div>
</section>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $(document).ready(function() {
        getRivalTeam();

        function getRivalTeam() {
            $.ajax({
                type: "GET",
                url: "/getrivalteam",
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    let len = 0;
                    if (response['rival'] != null) {
                        len = response['rival'].length;
                    }

                    if (len > 0) {
                        for (let index = 0; index < len; index++) {
                            const photo = response['rival'][index].photo_rival;
                            const id_rival = response['rival'][index].id_rival;
                            const name = response['rival'][index].name_rival;

                            const showTeam = '<div class="col-3">' +
                                '<div class="card">' +
                                '<img src="assets/img/rival/' + photo + '" alt="Avatar" style="width:100%">' +
                                ' <div class="container">' +
                                '<a href="rivalmember?id_rival=' + id_rival + '">' +
                                '<h4><b>' + name + '</b></h4>' +
                                '</a>' +
                                '<p>Team</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>';

                            $('#rival_team .row').append(showTeam);
                        }
                    }
                }
            });
        }

        $('#formAddRival').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 0) {
                        toastr["error"](data.msg);
                    } else {
                        toastr["success"](data.msg);
                        $('#addTeamRivalModal').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.addTeamRival', function(e) {
            e.preventDefault();
            $('#addTeamRivalModal').modal('show');
        });


    });
</script>
@stop