
@extends('layouts.app')
@section('content')
<main class='container'>
<section>  <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="titlebar">
                <h1>Editar Produto</h1>
            </div>
          @if ($errors->any())
          <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
          </div>
          @endif
            <div class="card">
               <div>
                    <label>Nome</label>
                    <input type="text" name="name" value="{{$product->name}}">
                    <label>Descrição (opcional)</label>
                    <textarea cols="10" rows="5"  name="description" value="{{$product->description}}">{{$product->description}}</textarea>
                    <label for="image">Adicionar imagem</label>
                    <img src="{{ asset('images/'. $product->image)}}" alt="File Preview" class="img-product" id="file-preview" />
                    <input type="hidden" name="hidden product image" value="{{$product->image}}">
                    <input type="file" placeholder="Escolher arquivo" name="image" accept="image/*" onchange="showFile(event)" required >
                </div>
               <div>
                    <label>Categoria</label>
                    <select  name="category">
                        @foreach(json_decode('{"Smartphone":"Smartphone", "Smart TV":"Smart TV", "Computer": "Computer"}', true) as $optionKey => $optionValue  )
                            <option value="{{$optionKey}}" {{(isset($product->category ) && ($product->category == $optionKey)? 'selected' : '') }}</option>{{$optionValue}}</option>
                        @endforeach
                    </select>
                    <hr>
                    <label>Inventário</label>
                    <input type="text" name="quantity" value="{{$product->quantity}}">
                    <hr>
                    <label>Preço</label>
                    <input type="text" name="price"  value="{{$product->price}}">
               </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <input type="hidden" name="hidden_id" value="{{$product->id}}" >
                <button >Salvar Alterações</button>
            </div>
        </form>
        </section>

        <script>

            //exibindo a imagem na tag img
            function showFile(event) {
                let input = event.target;
                let reader = new FileReader();
    
                reader.onload = function() {
                    let dataURL = reader.result;
                    let output = document.getElementById('file-preview');
                    output.src = dataURL; 
             }
    
        reader.readAsDataURL(input.files[0]);
}
        </script>
</main>
@endsection