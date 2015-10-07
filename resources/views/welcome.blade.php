@extends('app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title">Laravel 5</div>
        </div>
    </div>
@endsection

@section('cssTop')
    <style>
        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>

@endsection

