@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5">
            <table class="table table-striped table-bordered table-responsive">
                <thead>
                    <th>{{ __('account.members.username') }}</th>
                    <th>{{ __('account.members.created_at') }}</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><a href="{{ route('user.show', $user->uuid) }}">{{ $user->username }}</a></td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection