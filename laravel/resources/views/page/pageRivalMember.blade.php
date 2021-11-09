@extends('page.pageMain')
@section('title','Rival members')
@section('modal')
<!-- Modal -->
<div class="modal fade" id="statisticsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Statistics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" id="statRival">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>List</th>
                            <th>Got</th>
                            <th>Chance</th>
                            <th>Match</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMemberRivalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('member.addrival') }}" method="post" id="formAddStat">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD MEMBER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-1">
                            <div class="field">
                                <label class="label">Team</label>
                                <div class="control">
                                    <input class="input" type="text" value="{{ $id_rival }}" name="id_rival" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="field">
                                <label class="label">Name</label>
                                <div class="control">
                                    <input class="input" type="text" name="name_mr" placeholder="Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="field">
                                <label class="label">Position</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="position_mr">
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

<!-- Modal -->
<div class="modal fade" id="addStatisticsRival" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('stat.addmember') }}" method="post" id="formAddStatRival">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <h5> Position : <span id="position"></span></h5>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-1 col align-self-center">
                            ID :
                        </div>
                        <div class="col-1 text-center">
                            <input class="input" type="text" name="id_member" id="id_member" readonly value="0">
                        </div>
                        <div class="col-1">

                        </div>
                        <div class="col-2  align-self-center">
                            Team ID :
                        </div>
                        <div class="col-1 text-center">
                            <input class="input" type="text" name="id_rival" id="id_rival" readonly value="{{ $id_rival }}">
                        </div>
                    </div>
                    <div class="row text-center mt-5">
                        <div class="col-1">

                        </div>
                        <div class="col-2 text-left">
                            <p>Match</p>
                        </div>
                        <div class="col-5">
                            <p>List</p>
                        </div>
                        <div class="col-2">
                            <p>Got</p>
                        </div>
                        <div class="col-2">
                            <p>chance</p>
                        </div>
                    </div>
                    <div id="form_addstat">
                        <div class="row" id="row">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="button is-success" type="submit">Success</button>
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
    @if(Session::get('success'))
    <div class="notification is-info">
        {{ Session::get('success')}}
    </div>
    @endif

    @if(Session::get('error'))
    <div class="notification is-danger">
        {{ Session::get('error')}}
    </div>
    @endif
    <div class="block-user p-5">
        <div class="title-block">
            <div class="row">
                <div class="col-10">
                    <h1 class="font-block">{{ $namerival->name_rival }} Team</h1>
                </div>
                <div class="col-2 text-center">
                    <h1 class="font-block">For coach</h1>
                    <p>
                        <button class="button is-ghost is-light addMemberRival">
                            <span class="icon">
                                <i class="fas fa-user-plus"></i>
                            </span>
                            <span>ADD MEMBER</span>
                        </button>
                    </p>
                </div>
            </div>
        </div>
        <div class="table-block">
            <table class="table is-fullwidth">
                <thead style=" background: #090255;">
                    <tr>
                        <th class="has-text-white-bis">Number</th>
                        <th class="has-text-white-bis">Profile</th>
                        <th class="has-text-white-bis">Position</th>
                        <th class="has-text-white-bis" style="text-align: center;">Statistics</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $item)
                    <tr>
                        <td>
                            <p>{{ $item->id_mr }}</p>
                        </td>
                        <td>
                            <p>{{ $item->name_mr }}</p>
                        </td>
                        <td>
                            <p>{{ $item->position_mr }}</p>
                        </td>
                        <td style="text-align: center;">
                            <button class='button is-primary addStatisticRival' value='{{ $item->id_mr }}'>ADD</button>
                            <button type="button" class="myModala button is-ghost is-inverted" value="{{ $item->id_mr }}">DETAILS</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
        $(document).on('click', '.addStatisticRival', function(e) {
            e.preventDefault();
            $('#addStatisticsRival').modal('show');
            let id_mr = $(this).val();
            $.ajax({
                type: "GET",
                url: "/rivalmember/" + id_mr,
                dataType: 'json',
                success: function(response) {
                    const id_match = response['maxid'] + 1;
                    const position = response['position'];
                    // console.log(response);
                    let len = 0;
                    if (response['list'] != null) {
                        len = response['list'].length;
                    }
                    $('#position').text(position);
                    $('#id_member').val(id_mr);
                    $('#form_addstat #row').empty();
                    if (len > 0) {
                        for (let i = 0; i < len; i++) {
                            const list = response['list'][i].name_list;

                            const statform = '<div class="col-1"></div>' +
                                '<div class="col-2">' +
                                ' <div class="field">' +
                                '<p class="control">' +
                                '<input class="form-control-plaintext" type="text" name="more[' + i + '][id]" readonly value="' + id_match + '">' +
                                ' </p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-5">' +
                                ' <div class="field">' +
                                '<p class="control">' +
                                '<input class="form-control-plaintext" type="text" name="more[' + i + '][list]" readonly value="' + list + '">' +
                                ' </p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-2">' +
                                ' <div class="field">' +
                                '<p class="control">' +
                                '<input class="input" type="number" name="more[' + i + '][got]" value="0">' +
                                ' </p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-2">' +
                                ' <div class="field">' +
                                '<p class="control">' +
                                '<input class="input" type="number" name="more[' + i + '][chance]" value="0">' +
                                ' </p>' +
                                '</div>' +
                                '</div>';

                            $('#form_addstat #row').append(statform);
                        }
                    }
                }
            });
        });

        $('#formAddStatRival').on('submit', function(e) {
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
                        $('#addStatisticsRival').modal('hide');
                    }
                }
            })
        });


        $(document).on('click', '.addMemberRival', function(e) {
            e.preventDefault();
            $('#addMemberRivalModal').modal('show');
        });

        $(document).on('click', '.myModala', function(e) {
            e.preventDefault();
            var id_mr = $(this).val();
            // console.log(id_mr);
            $('#statisticsModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/rivalmember/" + id_mr,
                success: function(response) {
                    var len = 0;
                    if (response['listSta'] != null) {
                        len = response['listSta'].length;
                    }
                    $('#statRival tbody').empty();
                    if (len > 0) {
                        for (let index = 0; index < len; index++) {
                            const id_match = response['listSta'][index].id_match;
                            const list = response['listSta'][index].list;
                            const got = response['listSta'][index].got;
                            const chance = response['listSta'][index].chance;



                            const tr_str = "<tr>" +
                                "<td><p>" + (index + 1) + "</p></td>" +
                                "<td><p>" + (list) + "</p></td>" +
                                "<td><p>" + (got) + "</p></td>" +
                                "<td><p>" + (chance) + "</p></td>" +
                                "<td><p>" + (id_match) + "</p></td>" +
                                "</tr>";

                            $('#statRival tbody').append(tr_str);
                        }
                    } else {
                        const tr_str = "<tr>" +
                            "<td align='center' colspan='5'>Empty</td>" +
                            "</tr>";
                        $('#statRival tbody').append(tr_str);
                    }
                }
            });
        });
    })
</script>
@stop