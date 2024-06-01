@extends('layouts.app')
@section('content')
<main class='container'>
<section>  <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="titlebar">
                <h1>Cadastrar produto</h1>
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
                    <input type="text" name="name" required>
                    <label>Descrição (opcional)</label>
                    <textarea cols="10" rows="5"  name="description"></textarea>
                    <label>Adicionar imagem</label>
                    <img src="" alt="File Preview" class="img-product" id="file-preview" />
                    <input type="file" name="image" accept="image/*" onchange="showFile(event)" required >
                </div>
               <div>
                    <label>Categoria</label>
                    <select  name="category">
                        @foreach(json_decode('{"Smartphone":"Smartphone", "Smart TV":"Smart TV", "Computer": "Computer"}', true) as $optionKey => $optionValue  )
                            <option value="{{$optionKey}}">{{$optionValue}}</option>
                        @endforeach
                    </select>
                    <hr>
                    <label>Inventário</label>
                    <input type="text" name="quantity">
                    <hr>
                    <label>Preço</label>
                    <input type="text" name="price">
               </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <button >Cadastrar</button>
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