@extends('page.pageMain')
@section('title','Statistics')
@section('modal')
<!-- Modal -->
<div class="modal fade modal-z" id="myStatisticsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Statistics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" id="stat">
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
<div class="modal fade" id="addStatistics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Statistics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <h5> Position : </h5>
                    <div class="row text-center mt-3">
                        <div class="col">
                            <p>List</p>
                        </div>
                        <div class="col">
                            <p>Got</p>
                        </div>
                        <div class="col">
                            <p>chance</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="field">
                                <p class="control">
                                    <input class="input" type="text" placeholder="Your email" disabled>
                                </p>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">

                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="button is-success" type="submit">Success</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('body')
<section class="section">
    <h1 class="title">Statistics</h1>
    <div class="block-user">
        <div class="title-block">
            <div class="row">
                <div class="col-10">
                    <h1 class="font-block">Player</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                </div>
                <div class="col-2 text-center">
                    <h1 class="font-block">For coach</h1>
                    <p><a class="">ADD</a> | <a href="">EDIT</a> </p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="table-block" style="margin-top: -30px;">
                <table class="table is-fullwidth" id="table_stat">
                    <thead style=" background: #090255;">
                        <tr>
                            <th class="has-text-white-bis text-center">Number</th>
                            <th class="has-text-white-bis">Profile</th>
                            <th class="has-text-white-bis">Position</th>
                            <th class="has-text-white-bis" style="text-align: center;">Statistics</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</section>
<script>
    $(document).ready(function() {
        getStatistics();

        function getStatistics() {
            $.ajax({
                type: "GET",
                url: "/getstatistics",
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var len = 0;
                    if (response['player'] != null) {
                        len = response['player'].length;
                    }

                    $('#table_stat tbody').empty();

                    if (len > 0) {
                        for (let index = 0; index < len; index++) {
                            const name = response['player'][index].name;
                            const position = response['player'][index].position;
                            const id = response['player'][index].id_m;


                            const tr_str = "<tr>" +
                                "<td class='text-center'><p>" + (index + 1) + "</p></td>" +
                                "<td><p>" + (name) + "</p></td>" +
                                "<td><p>" + (position) + "</p></td>" +
                                "<td class='text-center'><p> " +
                                "<button class='button is-primary addStatistic' value='" + id + "'>ADD</button>" +
                                "<button class='button is-ghost myModalaStat' value='" + id + "'>DETAILS</button>" +
                                "</p></td>" +
                                "</tr>";

                            $('#table_stat tbody').append(tr_str);
                        }
                    } else {
                        const tr_str = "<tr>" +
                            "<td align='center' colspan='3'>Empty</td>" +
                            "</tr>";
                        $('#table_stat tbody').append(tr_str);
                    }
                }
            });
        }

        $(document).on('click', '.addStatistic', function(e) {
            e.preventDefault();
            $('#addStatistics').modal('show');
            let id_m = $(this).val();
            console.log(id_m);

        });

        $(document).on('click', '.myModalaStat', function(e) {
            e.preventDefault();
            var id_m = $(this).val();
            console.log(id_m);
            $('#myStatisticsModal').modal('show');
            $.ajax({
                type: "get",
                url: "/statistics/" + id_m,
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response['statistics'] != null) {
                        len = response['statistics'].length;
                    }

                    $('#stat tbody').empty();

                    if (len > 0) {
                        for (let index = 0; index < len; index++) {
                            // const name_mr = response['statistics'][index].name_mr;
                            // const position_mr = response['statistics'][index].position_mr;
                            const id_match = response['statistics'][index].id_match;
                            const list = response['statistics'][index].list;
                            const got = response['statistics'][index].got;
                            const chance = response['statistics'][index].chance;



                            const tr_str = "<tr>" +
                                "<td><p>" + (index + 1) + "</p></td>" +
                                "<td><p>" + (list) + "</p></td>" +
                                "<td><p>" + (got) + "</p></td>" +
                                "<td><p>" + (chance) + "</p></td>" +
                                "<td><p>" + (id_match) + "</p></td>" +
                                "</tr>";

                            $('#stat tbody').append(tr_str);
                        }
                    } else {
                        const tr_str = "<tr>" +
                            "<td align='center' colspan='3'>Empty</td>" +
                            "</tr>";
                        $('#stat tbody').append(tr_str);
                    }
                }
            });
        });

    })
</script>
@stop