@extends('layouts.app')
@section('content')
<main class="container">
        <section>
            <div class="titlebar" style="justify-content: center;">
                <h1>Seja Bem Vindo ao Gerenciador de Produtos</h1>
            </div>
            <div class="titlebar">
                <h5>Escolha uma ação para continuar: </h5>
                <a href="{{ route('products.index')}}" class="btn-link" >Listar Produtos</a>
                <a href="{{ route('products.create')}}" class="btn-link" >Cadastrar Produto</a>
            </div>
        </section>
</main>
@endsection