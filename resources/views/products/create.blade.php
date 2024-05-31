@extends('layouts.app')
@section('content')
<main class='container'>
<section>  <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <div class="titlebar">
                <h1>Add Product</h1>
                <button>Save</button>
            </div>
          
            <div class="card">
               <div>
                    <label>Name</label>
                    <input type="text" name="name">
                    <label>Description (optional)</label>
                    <textarea cols="10" rows="5"  name="description"></textarea>
                    <label>Add Image</label>
                    <img src="" alt="File Preview" class="img-product" id="file-preview"/>
                    <input type="file" name="image" accept="image/*" onchange="showFile(event)" >
                </div>
               <div>
                    <label>Category</label>
                    <select  name="category">
                        @foreach(json_decode('{"Smartphone":"Smartphone", "Smart TV":"Smart TV", "Computer": "Computer"}', true) as $optionKey => $optionValue  )
                            <option value="{{$optionKey}}">{{$optionValue}}</option>
                        @endforeach
                    </select>
                    <hr>
                    <label>Inventory</label>
                    <input type="text" name="quantity">
                    <hr>
                    <label>Price</label>
                    <input type="text" name="price">
               </div>
            </div>
        </form>
            <div class="titlebar">
                <h1></h1>
                <button>Save</button>
            </div>
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