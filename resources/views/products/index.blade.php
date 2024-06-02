@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Produtos</title>
</head>
<body>
<main class="container">
        <section>
            <div class="titlebar">
                <h1>Produtos</h1>
                @if($message= Session::get('success'))
                <script type="text/javascript">
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Cadastrado com sucesso"
                    });
                </script>
                @else
                @endif             
                <a href="{{ route('products.create')}}" class="btn-link">Adicionar Produto</a>
            </div>

            <div class="table">
                <div class="table-filter">
                    <div>   
                        <ul class="table-filter-list">
                            <li>
                                <p class="table-filter-link link-active">All</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <form action="{{route('products.index')}}" method="GET" accept-charset="UTF-8" role=""search>
                    <div class="table-search">   
                        <div>
                            <button class="search-select">
                                Buscar produto
                            </button>
                            <span class="search-select-arrow">
                                <i class="fas fa-caret-down"></i>
                            </span>
                        </div>
                        <div class="relative">
                            <input class="search-input" type="text" name="search" placeholder="Buscar produto..." value="{{ request('search') }}">
                        </div>
                    </div>
                </form>

                <div class="table-product-head">
                    <p>Imagem</p>
                    <p>Nome</p>
                    <p>Categoria</p>
                    <p>Inventário</p>
                    <p>Ações</p>
                </div>

                <div class="table-product-body">
                    @if(count ($products) > 0)
                        @foreach($products as $product)
                    <img src="{{asset('images/' . $product->image)}}"/>
                    <p>{{$product->name}}</p>
                    <p>{{$product->category}}</p>
                    <p>{{$product->quantity}}</p>
                    <div class="actions-btn">
                        <a href="{{route('products.edit', $product->id)}}" class="btn-link btn btn-success" >
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{route('products.destroy', $product->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" onclick="deleteConfirm(event)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>

                    @endforeach
                    @else
                        <p>Produto não encontrado</p>
                    @endif
                </div>

                <div class="table-paginate">
                    {{$products->links('layouts.pagination')}}
                </div>
            </div>
        </section>
</main>

<script>
    window.deleteConfirm = function (e){
        e.preventDefault();
        let form = e.target.form;
        Swal.fire({
        title: "Você tem certeza que deseja excluir?",
        text: "Essa ação é irreversível!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, excluir!",
        cancelButtonText:"Cancelar"
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        });
    }
    </script>

    </body>
</html>
@endsection

