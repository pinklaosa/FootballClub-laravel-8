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
                    <!-- <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>List</th>
                                <th>Got</th>
                                <th>Chance</th>
                            </tr>
                        </thead>
                        <tbody id="tlist">
                        </tbody>
                    </table> -->
                    <h5>Match : 1</h5>
                    <p id="list1"></p>
                    <h5>Match : 2</h5>
                    <p id="list2"></p>
                </div>
                <div class="modal-footer">
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
            <h1 class="font-block">{{ $namerival->name_rival }}</h1>
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
                        <td>{{ $item->id_mr }}</td>
                        <td>{{ $item->name_mr }}</td>
                        <td>{{ $item->position_mr }}</td>
                        <td style="text-align: center;"><button  type="button" class="myModala button is-link is-inverted" value="{{ $item->id_mr }}">more</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).on('click', '.myModala', function(e) {
        e.preventDefault();
        var id_mr = $(this).val();
        // console.log(id_mr);
        $('#statisticsModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/rivalmember/"+id_mr,
            success: function (response){
                const listArray_1 = response.listSta;
                // const listArray_2 = response.listSta;
                // // console.log(listArray);
                const listObj = listArray_1.map((l) => (
                    {
                        list:l.list,
                        got:l.got,
                        chance:l.chance,
                        id_match:l.id_match,
                    }
                )
                );

                
                let text1 = "";
                let text2 = "";
                if(response.status == 200){
                    // $.each(response.listSta,function (key,item){
                    //     $('#tlist').append(
                    //         '<tr>\
                    //             <td>'+item.list+'</td>\
                    //             <td>'+item.got+'</td>\
                    //             <td>'+item.chance+'</td>\
                    //         </tr>'
                    //     );
                       
                    // });
                    for(let i=0;i<listObj.length;i++){
                        if(listObj[i].id_match == 1){
                           text1 += listObj[i].list+" ทำได้ : "+listObj[i].got+" โอกาส : "+listObj[i].chance+"<br>"; 
                        }
                        else{
                            text2 += listObj[i].list+" ทำได้ : "+listObj[i].got+" โอกาส : "+listObj[i].chance+"<br>"; 
                        }
                        
                    }
                    document.getElementById("list1").innerHTML = text1;
                    document.getElementById("list2").innerHTML = text2;
                }
            }
        });
    });
</script>
@stop