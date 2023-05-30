@extends('layouts.app')

@section('content')
<div class="signin-page-container">
    <div class="signin-form-div">
        <h1 class=signin-title>Entrar</h1>
        @if (session("status"))
            <div class="invalid-login-message">
                {{ session("status") }}
            </div>
        @endif
        <form class="signin-form" action="{{ route('signin') }}" method="post">
            @csrf
            <div class="input-wrapper">
                <label for="email" class="input-label">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" value={{ old("email") }}>
                @error("email")
                <div class="field-error">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class=input-wrapper>
                <label for="password" class="input-label">Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" value={{ old("password") }}>
                @error("password")
                <div class="field-error">
                    {{ $message }}
                </div>
                @enderror
            </div>
                <div class="checkbox-wrapper">
                   <input type="checkbox" id="remember" name="remember">
                   <label for="remember">Manter conectado</label>
                </div>
            <button class="submit-button" type="submit">Entrar</button>
            <p class="form-footer">Não possui uma conta? <a class="form-footer-link" href={{ route("register") }}>Cadastrar</a></p>
        </form>
    </div>
</div>
@endsection
