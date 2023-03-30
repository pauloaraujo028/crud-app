@extends('layouts.app')
@section('content')
  <main class="container">
    <section>
      <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="titlebar">
            <h1>Cadastrar Produtos</h1>
        </div>
        @if ($errors->any())
          <div>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="card">
            <div>
                <label>Nome</label>
                <input type="text" name="name" required >
                <label>Descrição (opcional)</label>
                <textarea cols="10" rows="5" name="description" required ></textarea>
                <label>Adicionar Imagem</label>
                <img src="" alt="" class="img-product" id="file-preview" />
                <input type="file" name="image" accept="image/*" onchange="showFile(event)" required >
            </div>
            <div>
                <label>Categoria</label>
                <select  name="category" >
                  @foreach (json_decode('{"Smartphone":"Smartphone", "Smart TV":"Smart TV", "PC":"PC"}', true) as $optionKey => $optionValue)
                    <option value="{{ $optionKey }}" >{{ $optionValue }}</option>
                  @endforeach
                </select>
                <hr>
                <label>Quantidade</label>
                <input type="number" name="quantity" max="1000" required >
                <hr>
                <label>Preço</label>
                <input type="number" name="price" min="1" max="10000" required >
            </div>
        </div>
        <div class="titlebar" style="justify-content: center; gap: 10px;">
            <h1></h1>
            <button class="btn-link btn-success">Salvar</button>
            <a href="{{route('products.index')}}" class="btn-link btn-danger">Voltar</a>
        </div>
      </form>
    </section>
  </main>
  <script>
    function showFile(event){
      var input = event.target;
      var reader = new FileReader();
      reader.onload = function(){
        var dataURL = reader.result;
        var output = document.getElementById('file-preview');
        output.src = dataURL;
      }
      reader.readAsDataURL(input.files[0]);
    }
  </script>
@endsection