@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$mfo->title}} ({{$mfo->name}})</div>

                    <div class="card-body">
                        @foreach($mfo->settings As $setting)
                            <h4> {{$setting->type->title}} ({{ $setting->{'key'} }}) </h4>
                            <p> <?php
                                    if( is_array($setting->value) ) {
                                        echo implode(', ', $setting->value);
                                    }
                                    else if( is_bool($setting->value) ) {
                                        echo $setting->value ? 'yes' : 'no';
                                    }
                                    else if( $setting->value instanceof \Carbon\Carbon ) {
                                        echo $setting->value->format('d.m.Y H:i:s');
                                    }
                                    else {
                                        echo $setting->value;
                                    }
                                ?>
                            </p>
                            <hr />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
