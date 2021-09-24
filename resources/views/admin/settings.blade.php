@extends('admin.layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">     
        <form action="{{ route('muonline.admin.settings_update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="sqlsrv_host">SQL Server Host</label>
                <input type="text" class="form-control @error('sqlsrv_host') is-invalid @enderror" id="sqlsrv_host" name="sqlsrv_host" placeholder="DESKTOP-XXX/SQLSERVER" value="{{ old('sqlsrv_host', setting('muonline.sqlsrv_host')) }}">

                @error('sqlsrv_host')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>

            <div class="form-group">
                <label for="sqlsrv_port">SQL Server Port</label>
                <input type="text" class="form-control @error('sqlsrv_port') is-invalid @enderror" id="sqlsrv_port" name="sqlsrv_port" value="{{ old('sqlsrv_port', setting('muonline.sqlsrv_port')) }}" aria-describedby="sqlsrv_port_info">

                @error('sqlsrv_port')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <small id="sqlsrv_port_info" class="form-text">Most of the time SQL Server doesn't have a port, you can leave it blank</small>
            </div>

            <div class="form-group">
                <label for="sqlsrv_username">SQL Server Username</label>
                <input type="text" class="form-control @error('sqlsrv_username') is-invalid @enderror" id="sqlsrv_username" name="sqlsrv_username" placeholder="MyNewAdminUser" value="{{ old('sqlsrv_username', setting('muonline.sqlsrv_username')) }}" aria-describedby="sqlsrv_username_info">

                @error('sqlsrv_username')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <small id="sqlsrv_username_info" class="form-text">For security reasons, please do not use the default <code>MyNewAdminUser</code> , create your own with the script!</small>
            </div>

            <div class="form-group">
                <label for="sqlsrv_password">SQL Server Password</label>
                <input type="text" class="form-control @error('sqlsrv_password') is-invalid @enderror" id="sqlsrv_password" name="sqlsrv_password" value="{{ old('sqlsrv_password', setting('muonline.sqlsrv_password')) }}"  aria-describedby="sqlsrv_password_info">

                @error('sqlsrv_password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <small id="sqlsrv_password_info" class="form-text">For security reasons, please do not use <code>abcd</code> as a password!</small>
            </div>

            <div class="form-group">
                <label for="sqlsrv_dbname">Database name</label>
                <input type="text" class="form-control @error('sqlsrv_dbname') is-invalid @enderror" id="sqlsrv_dbname" name="sqlsrv_dbname" value="{{ old('sqlsrv_dbname', setting('muonline.sqlsrv_dbname')) }}"  aria-describedby="sqlsrv_dbname_info">

                @error('sqlsrv_dbname')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <small id="sqlsrv_dbname_info" class="form-text">Your database name, usually <code>MuOnline</code> !</small>
            </div>

            <div class="form-group">
                <label for="game_maxonline">Max online players</label>
                <input type="number" min="1" class="form-control @error('game_maxonline') is-invalid @enderror" id="game_maxonline" name="game_maxonline" value="{{ old('game_maxonline', setting('muonline.game_maxonline')) }}"  aria-describedby="game_maxonline_info" required>

                @error('game_maxonline')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <small id="game_maxonline_info" class="form-text">Max players online on server, example <code>200</code> !</small>
            </div>

            <div class="form-group">
                <label for="game_resetzen">Required zen per reset</label>
                <input type="number" min="1" class="form-control @error('game_resetzen') is-invalid @enderror" id="game_resetzen" name="game_resetzen" value="{{ old('game_resetzen', setting('muonline.game_resetzen')) }}"  aria-describedby="game_resetzen_info" required>

                @error('game_resetzen')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <small id="game_resetzen_info" class="form-text">Zen required on character to make reset, example <code>10000</code> !</small>
            </div>

            <div class="form-group">
              <label for="server_files">Server files type</label>
              <select class="form-control" name="server_files" id="server_files">
                <option value="igcn">IGCN</option>
                <option value="xteam">XTeam / MuEmu</option>
              </select>
                @error('server_files')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
            </button>
        </form>

    </div>
</div>
@endsection