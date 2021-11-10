@extends('page.pageMain')
@section('title','Member')
@section('modal')
<!-- Modal Add member-->
<div class="modal fade" id="addPlayerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('player.add') }}" method="post" id="formAddPlayer">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD PLAYER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="field">
                                <label class="label">Name</label>
                                <div class="control">
                                    <input class="input" type="text" name="name" placeholder="Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="field">
                                <label class="label">Nickname</label>
                                <div class="control">
                                    <input class="input" type="text" name="nickname" placeholder="Nickname">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="field">
                                <label class="label">Number</label>
                                <div class="control">
                                    <input class="input" type="number" name="number" value="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <div class="field">
                                <label class="label">Status</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="status">
                                            <option value="ready">Ready</option>
                                            <option value="busy">Busy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="field">
                                <label class="label">Position</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="position">
                                            <option value="none">Select position</option>
                                            <option value="goalkeeper">Goalkeeper</option>
                                            <option value="defender">Defender</option>
                                            <option value="midfield">Midfield</option>
                                            <option value="forward">Forward</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="field">
                                <label class="label">Picture</label>
                                <input class="form-control" type="file" name="photo">
                            </div>
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

<!-- Modal Edit member-->
<div class="modal fade" id="editPlayerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('update.player') }}" method="post" id="formEditPlayer">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD PLAYER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-1">
                            <div class="field">
                                <label class="label">ID</label>
                                <div class="control">
                                    <input class="input" type="text" name="id" id="id" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="field">
                                <label class="label">Name</label>
                                <div class="control">
                                    <input class="input" type="text" name="name" id="edit_name" placeholder="Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="field">
                                <label class="label">Nickname</label>
                                <div class="control">
                                    <input class="input" type="text" name="nickname" id="edit_nickname" placeholder="Nickname">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="field">
                                <label class="label">Number</label>
                                <div class="control">
                                    <input class="input" type="number" name="number" id="edit_number" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <div class="field">
                                <label class="label">Status</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="status" id="edit_status">
                                            <option value="ready">Ready</option>
                                            <option value="busy">Busy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="field">
                                <label class="label">Position</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="position" id="edit_position">
                                            <option value="none">Select position</option>
                                            <option value="goalkeeper">Goalkeeper</option>
                                            <option value="defender">Defender</option>
                                            <option value="midfield">Midfield</option>
                                            <option value="forward">Forward</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="field">
                                <label class="label">Picture</label>
                                <input class="form-control" type="file" name="photo" id="edit_photo">
                            </div>
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

<!-- Modal delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure for delete this player ?
            </div>
            <div class="modal-footer">
                <button class="button is-danger deletedMember">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop
@section('body')
<section class="section">
    <h1 class="title">Football Player</h1>
    <div class="block-user">
        <div class="title-block">
            <h1 class="font-block">Player</h1>
            @if(session('type') === 'Coach')
            <div class="row">
                <div class="col-10"></div>
                <div class="col-2 text-center">
                    <h1 class="font-block">For coach</h1>
                    <p>
                        <button class="button is-light {{ session('type') === 'Coach' ? 'addPlayer' : null }}">
                            <span class="icon">
                                <i class="fas fa-user-plus"></i>
                            </span>
                            <span>ADD PLAYER</span>
                        </button>
                    </p>
                </div>
            </div>
            @endif
        </div>
        <section class="section" style="margin-top: -40px;">
            <div class="table-block">
                <table class="table is-fullwidth">
                    <thead style=" background: #090255;">
                        <tr>
                            <th class="has-text-white-bis text-center">Number</th>
                            <th class="has-text-white-bis">Profile</th>
                            <th class="has-text-white-bis">Position</th>
                            <th class="has-text-white-bis">Status</th>
                            @if(session('type') === 'Coach')
                            <th class="has-text-white-bis">Action</th>
                            @endif
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
                                            <img src="assets/img/profile/{{ $item->photo }}" alt="" class="img-avatar">
                                            <p>{{ $item->name }} <br>[ {{ $item->nickname }} ]</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>{{ $item->position }}</p>
                            </td>
                            @if( $item->status == "ready")
                            <td><span class="tag is-success">Ready</span></td>
                            @endif
                            @if( $item->status == "busy")
                            <td><span class="tag is-danger">Busy</span></td>
                            @endif
                            @if(session('type') === 'Coach')
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary editPlayer" value='{{ $item->id_m }}'>EDIT</button>
                                    <button type="button" class="btn btn-danger deletePlayer" value='{{ $item->id_m }}'>DELETE</button>
                                </div>
                            </td>
                            @endif
                            <!-- <td><i class='fas fa-user-edit' style='font-size:24px; color:#090255;'></i></td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

        $(document).on('click','.deletePlayer',function(e){
            e.preventDefault();
            $('#deleteModal').modal('show');
            let id_m = $(this).val();
            $(document).on('click','.deletedMember',function(e){
                $.ajax({
                    method: 'get',
                    url:'/deletedplayer/'+id_m,
                    dataType: 'json',
                    success: function(response){
                        if(response.code == 200){
                            toastr["success"](response.msg);
                            location.reload();
                        }else{
                            toastr["error"](response.msg);
                        }
                    }
                })
            });
        });


        $(document).on('click', '.addPlayer', function(e) {
            e.preventDefault();
            $('#addPlayerModal').modal('show');
        });

        $('#formAddPlayer').on('submit', function(e) {
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
                    if (data.code == 0) {
                        toastr["error"](data.msg);
                    } else if (data.code == 200) {
                        toastr["success"](data.msg);
                        location.reload();
                    }
                }
            })
        });

        $(document).on('click', '.editPlayer', function(e) {
            e.preventDefault();
            $('#editPlayerModal').modal('show');
            let id_m = $(this).val();
            $.ajax({
                url: '/geteditmember/' + id_m,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#edit_name').val(response['player'][0].name);
                    $('#edit_nickname').val(response['player'][0].nickname);
                    $('#edit_number').val(response['player'][0].number);
                    $('#edit_status').val(response['player'][0].status);
                    $('#edit_position').val(response['player'][0].position);
                    $('#id').val(id_m);
                }
            });
            $('#formEditPlayer').on('submit', function(e) {
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
                        if (data.code == 0) {
                            toastr["error"](data.msg);
                        } else if (data.code == 200) {
                            toastr["success"](data.msg);
                            location.reload();
                        }
                    }
                })
            });
        });
    });
</script>

@stop