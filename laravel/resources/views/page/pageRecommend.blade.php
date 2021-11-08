@extends('page.pageMain')
@section('title','Recommend')
@section('body')
<section class="section">
    <h1 class="title">Recommend</h1>
    <div class="card-rec">
        <div class="row">
            <div class="col-7 text-center mb-4">
                <h3 style="color:white">{{ $plan01 }}</h3>
            </div>
            <div class="col-5 text-center mb-4">
                <h3 style="color:white">Recommend Player</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-7">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="../assets/img/plan/{{ $plan01 }}.png" alt="" width="100%" class="mb-3">
                        <h5 style="color:white">Recommend</h5>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card-player" style="background-color: rgb(211, 211, 211);">
                    <h5 class="px-2">Goalkeeper</h5>
                    <hr>
                    <div class="container">
                        @foreach($listOne as $item)
                        @if( $item->position == "goalkeeper")
                        <div class="row">
                            <div class="col-2">-</div>
                            <div class="col">{{ $item->name }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-player" style="background-color: #7f7ab9;">
                    <h5 class="px-2">Defender</h5>
                    <hr>
                    <div class="container">
                        @foreach($listOne as $item)
                        @if( $item->position == "defender")
                        <div class="row">
                            <div class="col-2">-</div>
                            <div class="col">{{ $item->name }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-player" style="background-color: rgb(247, 247, 181);">
                    <h5 class="px-2">Midfield</h5>
                    <hr>
                    <div class="container">
                        @foreach($listOne as $item)
                        @if( $item->position == "midfield")
                        <div class="row">
                            <div class="col-2">-</div>
                            <div class="col">{{ $item->name }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-player">
                    <h5 class="px-2">Forward</h5>
                    <hr>
                    <div class="container">
                        @foreach($listOne as $item)
                        @if( $item->position == "forward")
                        <div class="row">
                            <div class="col-2">-</div>
                            <div class="col">{{ $item->name }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-rec mt-5">
        <div class="row">
            <div class="col-7 text-center mb-4">
                <h3 style="color:white">{{ $plan02 }}</h3>
            </div>
            <div class="col-5 text-center mb-4">
                <h3 style="color:white">Recommend Player</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-7">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="../assets/img/plan/{{ $plan02 }}.png" alt="" width="100%" class="mb-3">
                        <h5 style="color:white">Recommend</h5>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card-player" style="background-color: rgb(211, 211, 211);">
                    <h5 class="px-2">Goalkeeper</h5>
                    <hr>
                    <div class="container">
                        @foreach($listTwo as $item)
                        @if( $item->position == "goalkeeper")
                        <div class="row">
                            <div class="col-2">-</div>
                            <div class="col">{{ $item->name }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-player" style="background-color: #7f7ab9;">
                    <h5 class="px-2">Defender</h5>
                    <hr>
                    <div class="container">
                        @foreach($listTwo as $item)
                        @if( $item->position == "defender")
                        <div class="row">
                            <div class="col-2">-</div>
                            <div class="col">{{ $item->name }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-player" style="background-color: rgb(247, 247, 181);">
                    <h5 class="px-2">Midfield</h5>
                    <hr>
                    <div class="container">
                        @foreach($listTwo as $item)
                        @if( $item->position == "midfield")
                        <div class="row">
                            <div class="col-2">-</div>
                            <div class="col">{{ $item->name }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-player">
                    <h5 class="px-2">Forward</h5>
                    <hr>
                    <div class="container">
                        @foreach($listTwo as $item)
                        @if( $item->position == "forward")
                        <div class="row">
                            <div class="col-2">-</div>
                            <div class="col">{{ $item->name }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@stop