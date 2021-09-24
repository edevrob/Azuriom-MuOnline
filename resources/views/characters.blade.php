@extends('layouts.app')

@section('title', 'My characters')

@section('content')
    <div class="container content">
        <div class="row">
            <div class="col-12">
                <h4>My characters</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">{{ trans('muonline::character.account') }}</th>
                            <th scope="col">{{ trans('muonline::character.nickname') }}</th>
                            <th scope="col">{{ trans('muonline::character.level') }}</th>
                            <th scope="col">{{ trans('muonline::character.class') }}</th>
                            <th scope="col">{{ trans('muonline::character.resets') }}</th>
                            <th scope="col">{{ trans('muonline::character.money') }}</th>
                            <th scope="col">{{ trans('messages.fields.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
    
                            @foreach($character as $char)
                                <tr>
                                    <td>
                                        @if ($char->MuOnlineAccount)
                                            {{ $char->MuOnlineAccount->memb___id }}
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $char->Name }}
                                    </td>
                                    <td>
                                        {{ $char->cLevel }}
                                    </td>
                                    <td>
                                        <span class="badge badge-label badge-info">
                                            @php
                                                $class = $char->character_class($char->Class);
                                            @endphp
                                            {{ $class[0] }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $char->RESETS }}
                                    </td>
                                    <td>
                                        {{ $char->Money }}
                                    </td>
                                    <td>
                                        <a href="{{ route('muonline.accounts.charactersReset', $char->Name) }}" class="mx-1" title="Reset character" data-toggle="tooltip"><span class="badge badge-primary"><i class="fas fa-circle-notch"></i></span></a>
                                    </td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
