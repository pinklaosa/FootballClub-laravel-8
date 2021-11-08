@extends('page.pageMain')
@section('title','Analysis')
@section('body')
<section class="section">
    <h1 class="title">Analytics</h1>
    <div class="row">
        <div class="col-8">
            <div class="member-rival">
                <h1 class="font-block">Member rival</h1>
                <div class="container py-4">
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" id="mr">
                        <thead>
                            <th><h5>#</h5></th>
                            <th><h5>Name</h5></th>
                            <th><h5>Position</h5></th>
                        </thead>
                        <tbody>
                            <tr>
                            <td align="center" colspan='3'>Select rival team</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="block-user col-4">
            <div class="title-block pl-5">
                <h1 class="font-block">Select Rival</h1>
            </div>
            <div class="pl-5 pb-4 pr-5">
                <form action="{{ route('select.rival') }}" method="post">
                    @csrf
                    <div class="columns">
                        <div class="column is-12">
                            <div class="field">
                                <p class="control">
                                    <span class="select is-fullwidth">
                                        <select name="rival_team" id="rival_team">
                                            <option value="0">Select rival team</option>
                                            @foreach($list as $item)
                                            <option value="{{ $item->id_rival }}">{{ $item->name_rival }}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <img src="../assets/img/plan/plan.png" alt="" class="image-swap" width="100%">
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <p class="control">
                                    <span class="select is-fullwidth">
                                        <select name="plan_rivals" id="plan_rival">
                                            <option data-divid="../assets/img/plan/plan.png" value="0">Select a plan rival</option>
                                            <option data-divid="../assets/img/plan/4-4-2.png" value="4-4-2">4-4-2</option>
                                            <option data-divid="../assets/img/plan/4-4-2D.png" value="4-4-2D">4-4-2 Daimond</option>
                                            <option data-divid="../assets/img/plan/4-3-3.png" value="4-3-3">4-3-3</option>
                                            <option data-divid="../assets/img/plan/4-4-1-1.png" value="4-4-1-1">4-4-1-1</option>
                                            <option data-divid="../assets/img/plan/3-4-3.png" value="3-4-3">3-4-3</option>
                                            <option data-divid="../assets/img/plan/5-3-2.png" value="5-3-2">5-3-2</option>
                                        </select>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <button class="button is-link is-light is-fullwidth" type="submit">Select</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</section>
<script>
    $(document).ready(function() {
        $("#plan_rival").change(function() {
            var opt = $('option[value=' + this.value + ']', this);
            var divid = opt.data('divid');
            $('.image-swap').attr("src", divid);
        });
    });
    $(document).on('change', '#rival_team', function(e) {
        e.preventDefault();
        var id_mr = $(this).val();
        $.ajax({
            url: '/analysis/' + id_mr,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                var len = 0;
                if (response['data'] != null) {
                    len = response['data'].length;
                }

                $('#mr tbody').empty();

                if (len > 0) {
                    for (let index = 0; index < len; index++) {
                        const name_mr = response['data'][index].name_mr;
                        const position_mr = response['data'][index].position_mr;

                        const tr_str = "<tr>" +
                            "<td><p>" + (index + 1) + "</p></td>" +
                            "<td><p>" + (name_mr) + "</p></td>" +
                            "<td><p>" + (position_mr) + "</p></td>" +
                            "</tr>";

                        $('#mr tbody').append(tr_str);
                    }
                }else{
                    const tr_str = "<tr>"+
                    "<td align='center' colspan='3'>Select rival team</td>"
                    +"</tr>";
                    $('#mr tbody').append(tr_str);
                }
            }
        });


    });
</script>
@stop