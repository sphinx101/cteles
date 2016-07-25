@extends('app')

@section('content')
    <div id="carousel-generic" class="carousel slide" data-ride="carousel"data-interval="1000" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-generic" data-slide-to="1"></li>
            <li data-target="#carousel-generic" data-slide-to="2"></li>
            <li data-target="#carousel-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{ url('http://placehold.it/1200x315') }}" alt="Pareja enamorada">
                <div class="carousel-caption">
                    <h3>Chania</h3>
                    <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('/img/2.jpg') }}" alt="...">
                <div class="carousel-caption">
                    <h3>Chania</h3>
                    <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('/img/3.jpg') }}" alt="...">
                <div class="carousel-caption">
                    <h3>Chania</h3>
                    <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('/img/4.jpg') }}" alt="...">
                <div class="carousel-caption">
                    <h3>Chania</h3>
                    <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">anterior</span>
        </a>
        <a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">siguiente</span>
        </a>
    </div>
@endsection
