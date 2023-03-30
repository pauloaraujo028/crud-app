@extends('layouts.app')
@section('content')
<main class="container">
        <section>
            <div class="titlebar">
                <h1>Produtos</h1>
            </div>
            @if ($message = Session::get('success'))
              <script>
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                Toast.fire({
                  icon: 'success',
                  title: '{{$message}}'
                })
              </script>
            @endif
            <div class="table">
                <div class="table-filter">
                    <div>
                        <ul class="table-filter-list">
                            <li>
                              <a href="/">
                                <p class="table-filter-link link-active" style="margin-right: 20px;">Home</p>
                              </a>
                            </li>
                            <li>
                            <a href="{{ route('products.create')}}" >
                              <p class="table-filter-link link-active" style="margin-right: 10px">Cadastrar</p>
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="GET" action="{{route('products.index')}}" accept-charset="UTF-8" role="search">
                  <div class="table-search"> 
                      <div class="relative">
                          <input class="search-input" type="text" name="search" placeholder="Pesquisar Produtos..." value="{{ request('search') }}">
                      </div>  
                      <div>
                          <button class="search-select">
                            Buscar
                          </button>
                      </div>
                      
                  </div>
                </form>
                <div class="table-product-head">
                    <p>Imagem</p>
                    <p>Nome</p>
                    <p>Categoria</p>
                    <p>Quantidade</p>
                    <p>Preço</p>
                    <p>Ações</p>
                </div>
                <div class="table-product-body">
                  @if (count($products) > 0)
                    @foreach ($products as $product)
                      <img src="{{asset('images/' . $product->image)}}"/>
                      <p>{{$product->name}}</p>
                      <p>{{$product->category}}</p>
                      <p>{{$product->quantity}}</p>
                      <p>{{$product->price}}</p>
                      <div style="display: flex; gap: 10px;">     
                          <a href="{{route('products.edit', $product->id)}}" class="btn-action btn btn-success"  >
                              <i class="fas fa-pencil-alt" ></i> 
                          </a>
                          <form method="post" action="{{ route('products.destroy', $product->id)}}" style="display: flex;" >
                            @method('delete')
                            @csrf
                              <button class="btn-action btn btn-danger" onclick="deleteConfirm(event)" style="margin-top: 0;" >
                                <i class="far fa-trash-alt"></i>
                              </button>
                          </form>
                      </div>
                    @endforeach
                  @endif

                </div>
                <div class="table-paginate">
                    <div class="pagination">
                        <a href="#" disabled>&laquo;</a>
                        <a class="active-page">1</a>
                        <a>2</a>
                        <a>3</a>
                        <a href="#">&raquo;</a>
                    </div>
                </div>
            </div>
        </section>
</main>
<script>
  window.deleteConfirm = function (e) {
    e.preventDefault();
    var form = e.target.form;
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não será capaz de reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, apague!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deletado!',
          'Seu arquivo foi excluído.',
          'success'
        ) 
        form.submit();
      }
    })
  }
</script>
@endsection