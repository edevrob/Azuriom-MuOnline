@extends('admin.layouts.admin')

@section('title', trans('muonline::character.title'))

@section('content')
    <form class="form-inline mb-3" action="{{ route('muonline.admin.characters') }}" method="GET">
        <div class="form-group mb-2">
            <label for="searchInput" class="sr-only">{{ trans('messages.actions.search') }}</label>

            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" name="search" value="{{ $search ?? '' }}" placeholder="{{ trans('messages.actions.search') }}">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">{{ trans('muonline::character.username') }}</th>
                        <th scope="col">{{ trans('muonline::character.nickname') }}</th>
                        <th scope="col">{{ trans('muonline::character.level') }}</th>
                        <th scope="col">{{ trans('muonline::character.class') }}</th>
                        <th scope="col">{{ trans('muonline::character.resets') }}</th>
                        <th scope="col">{{ trans('messages.fields.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($character as $char)
                            <tr>
                                <th scope="row">
                                    @if ($char->MuOnlineAccount)
                                        {{ $char->MuOnlineAccount->memb_name }}
                                    @else
                                        <p>-</p>
                                    @endif
                                </th>
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
                                    <a href="{{ route('muonline.admin.charactersEdit', $char->Name) }}" class="mx-1" title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i class="fas fa-edit text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $character->links() }}
            </div>
        </div>
    </div>
@endsection
