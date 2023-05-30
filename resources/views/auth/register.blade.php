@extends('layouts.app')

@section('content')
<div class="register-page-container">
    <div class="register-form-div">
        <h1 class=register-title>Cadastrar</h1>
        <form class="register-form" action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-wrapper">
                <label for="name" class="input-label">Nome</label>
                <input type="text" name="name" placeholder="Digite seu nome" value={{ old("name") }}>
            @error("name")
                <div class="field-error">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="input-wrapper">
                <label for="email" class="input-label">Email</label>
                <input type="email" name="email" placeholder="Digite seu email" value={{ old("email") }}>
            @error("email")
                <div class="field-error">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="input-wrapper">
                <label for="password" class="input-label">Senha</label>
                <input type="password" name="password" placeholder="Digite sua senha" value={{ old("password") }}>
            @error("password")
                <div class="field-error">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="input-wrapper">
                <label for="password" class="input-label">Confirme a senha</label>
                <input type="password" name="password_confirmation" placeholder="Confirme sua senha">
            </div>
            <button class="submit-button" type="submit">Cadastrar</button>
            <p class="form-footer">Já possui uma conta? <a class="form-footer-link" href={{ route("signin") }}>Entrar</a></p>
        </form>
    </div>
</div>
@endsection
