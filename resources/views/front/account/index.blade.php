@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">My account</div>

        <div class="card-body">
            <table class="table">
                <tr>
                    <td>{{ __('E-mail') }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>{{ __('Registered from') }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            </table>
        </div>

        <div class="card-footer ">
            <a class="btn btn-sm btn-outline-primary" href="">{{ __('Edit') }}</a>
        </div>
    </div>

@endsection
