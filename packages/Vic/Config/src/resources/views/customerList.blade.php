@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Список</div>

                    <div class="card-body">
                        @foreach($mfoList As $mfo)
                            <h4><a href="{{$mfo->getSettingPageUrl()}}">{{$mfo->title}}</a> ({{$mfo->name}})</h4>
                            <hr />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
