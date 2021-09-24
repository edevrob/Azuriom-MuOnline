@extends('layouts.app')

@section('title', 'Game accounts')

@section('content')

    <div class="container content">
        <div class="row">
            <div class="col-12">
                <h4>Game accounts</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col"># of characters</th>
                            <th scope="col">CSPoints</th>
                            <th scope="col">WCoinC</th>
                            <th scope="col">WCoinP</th>
                            <th scope="col">{{ trans('messages.fields.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->accounts as $item)
                            <tr>
                                <td>{{$item->memb___id}}</td>
                                <td>{{$item->characters()->count()}}</td>
                                <td>{{$item->cspoints ?? '0'}}</td>
                                <td>{{$item->CashShopData ? $item->CashShopData->WCoinC : '-'}}</td>
                                <td>{{$item->CashShopData ? $item->CashShopData->WCoinP : '-'}}</td>
                                <td>
                                    <a href="{{route('muonline.accounts.edit', $item)}}" class="mx-1" title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">Create a game account</div>
                    <div class="card-body">
                        <form action="{{route('muonline.accounts.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Account Name</label>
                                <input type="text" name="account" class="form-control @error('account') is-invalid @enderror" id="exampleInputEmail1">
                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">{{ trans('auth.confirm-password') }}</label>
                                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">Link an existing account</div>
                    <div class="card-body">
                        <form action="{{route('muonline.accounts.link')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Account Name</label>
                                <input type="text" name="account" class="form-control @error('account') is-invalid @enderror" id="exampleInputEmail1">
                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
