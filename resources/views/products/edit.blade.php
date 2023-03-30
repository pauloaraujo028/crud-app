@extends('layouts.app')
@section('content')
  <main class="container">
    <section>
      <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="titlebar">
            <h1>Editar Produto</h1>
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
                <input type="text" name="name" value="{{ $product->name }}" >
                <label>Descrição (opcional)</label>
                <textarea cols="10" rows="5" name="description" value="{{ $product->description }}" >{{ $product->description }}</textarea>
                <label>Adicionar Imagem</label>
                <img src="{{ asset('images/'.$product->image) }}" alt="" class="img-product" id="file-preview" />
                <input type="hidden" name="hidden_product_image" value="{{$product->image}}" >
                <input type="file" name="image" accept="image/*" onchange="showFile(event)" >
            </div>
            <div>
                <label>Categoria</label>
                <select  name="category" >
                  @foreach (json_decode('{"Smartphone":"Smartphone", "Smart TV":"Smart TV", "PC":"PC"}', true) as $optionKey => $optionValue)
                    <option value="{{ $optionKey }}" {{ (isset($product->category) && $product->category === $optionKey) ? 'selected' : '' }} >{{ $optionValue }}</option>
                  @endforeach
                </select>
                <hr>
                <label>Quantidade</label>
                <input type="number" name="quantity" value="{{$product->quantity}}" max="1000">
                <hr>
                <label>Preço</label>
                <input type="number" name="price" value="{{$product->price}}" min="1" max="10000" >
            </div>
        </div>
        <div class="titlebar" style="justify-content: center; gap: 10px;">
            <h1></h1>
            <button class="btn-link btn-success">Salvar</button>
            <a href="{{route('products.index')}}" class="btn-link btn-danger">Voltar</a>
            <input type="hidden" name="hidden_id" value="{{ $product->id}}" >
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