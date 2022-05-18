@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
    <div class="card" style="margin: 20px!important;">
        <h5 class="card-header">Order Create</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.cart.update', ['id' => $cart->id]) }}" >
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Produit :</label>
                            <select onchange="showImage()" required name="product" id="product" class="form-control selectpicker" data-live-search="true">
                                <option value="">--Select Product--</option>
                                @foreach($products as $product)
                                    <option @if($cart->product_id == $product->id) selected @endif data-tokens="{{ $product->title }}" value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="status">Type :</label>
                            <select required name="types" id="type" class="form-control">
                                <option value="">--Select Type--</option>
                                <option @if($cart->type == 'personalized') selected @endif value="personalized">Personalisé</option>
                                <option @if($cart->type == 'logo') selected @endif value="logo">Logo</option>
                                <option  @if($cart->type == 'standard') selected @endif value="standard">Standard</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="price" class="col-form-label">Price<span class="text-danger">*</span></label>
                            <input id="price" type="number" name="price" placeholder="Enter price" value="{{ $cart->price }}"
                                   class="form-control" required>
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="color">Color :</label>
                            <select  name="color" id="color" class="form-control">
                                <option value="">--Select color--</option>
                                <option @if($cart->variation == 'Blue') selected @endif value="Blue" >Blue</option>
                                <option @if($cart->variation == 'Rouge') selected @endif value="Rouge" >Rouge</option>
                                <option @if($cart->variation == 'Blanc') selected @endif value="Blanc" >Blanc</option>
                                <option @if($cart->variation == 'Rose') selected @endif value="Rose" >Rose</option>
                                <option @if($cart->variation == 'Jaune') selected @endif value="Jaune" >Jaune</option>
                                <option @if($cart->variation == 'Orange') selected @endif value="Orange" >Orange</option>
                                <option @if($cart->variation == 'Vert') selected @endif value="Vert" >Vert</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="size">Size :</label>
                            <select  name="size" id="" class="form-control">
                                <option @if($cart->taille == 'personalized') selected @endif value="">--Select Size--</option>
                                <option @if($cart->taille == 'XS') selected @endif value="XS" >XS</option>
                                <option @if($cart->taille == 'S') selected @endif value="S" >S</option>
                                <option @if($cart->taille == 'M') selected @endif value="M" >M</option>
                                <option @if($cart->taille == 'L') selected @endif value="L" >L</option>
                                <option @if($cart->taille == 'XL') selected @endif value="XL" >XL</option>
                                <option @if($cart->taille == 'XXL') selected @endif value="XXL" >XXL</option>
                            </select>
                        </div>
                        <div class="form-group" id="text_group" >
                            <label for="text">Saisissez votre texte :</label>
                            <br>
                            <input type="text" name="text" id="text" class="form-control" value="{{ $cart->text }}">
                        </div>
                        <div class="form-group" id="option_group" >
                            <label for="option">Option supplementaire <span style="color: #727b84">(Police, Taille ...)</span></label>
                            <br>
                            <textarea name="options" id="option" cols="30" rows="2" class="form-control">{{ $cart->options }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success form-control">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
