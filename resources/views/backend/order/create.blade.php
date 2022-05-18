@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
    <div class="card" style="margin: 20px!important;">
        <h5 class="card-header">Order Create</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('order.storeAdmin') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Produit :</label>
                            <select onchange="showImage()" required name="product" id="product" class="form-control selectpicker" data-live-search="true">
                                <option value="">--Select Product--</option>
                                @foreach($products as $product)
                                    <option data-tokens="{{ $product->title }}" value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="status">Type :</label>
                            <select required name="types" id="type" class="form-control">
                                <option value="">--Select Type--</option>
                                <option value="personalized">Personalisé</option>
                                <option value="logo">Logo</option>
                                <option value="standard">Standard</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="price" class="col-form-label">Price<span class="text-danger">*</span></label>
                            <input id="price" type="number" name="price" placeholder="Enter price" value="{{old('price')}}"
                                   class="form-control" required>
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="shipping" class="col-form-label">Shipping</label>
                            <input id="shipping" type="number" name="shipping" placeholder="Enter Shipping" value="{{old('shipping')}}"
                                   class="form-control">
                            @error('shipping')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="color">Color :</label>
                            <select  name="color" id="color" class="form-control">
                                <option value="">--Select color--</option>
                                <option value="Blue" >Blue</option>
                                <option value="Rouge" >Rouge</option>
                                <option value="Blanc" >Blanc</option>
                                <option value="Rose" >Rose</option>
                                <option value="Jaune" >Jaune</option>
                                <option value="Orange" >Orange</option>
                                <option value="Vert" >Vert</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="size">Size :</label>
                            <select  name="size" id="" class="form-control">
                                <option value="">--Select size--</option>
                                <option value="XS" >XS</option>
                                <option value="S" >S</option>
                                <option value="M" >M</option>
                                <option value="L" >L</option>
                                <option value="XL" >XL</option>
                                <option value="XXL" >XXL</option>
                            </select>
                        </div>
                        <div class="form-group" id="text_group" >
                            <label for="text">Saisissez votre texte :</label>
                            <br>
                            <input type="text" name="text" id="text" class="form-control">
                        </div>
                        <div class="form-group" id="option_group" >
                            <label for="option">Option supplementaire <span style="color: #727b84">(Police, Taille ...)</span></label>
                            <br>
                            <textarea name="options" id="option" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select required name="status" id="" class="form-control">
                                <option value="">--Select Status--</option>
                                <option value="Prise de commande" >Prise de commande</option>
                                <option value="En Fabrication" >En Fabrication</option>
                                <option value="Préparation Alger" >Préparation Alger</option>
                                <option value="Livraison Alger" >Livraison Alger</option>
                                <option value="Préparation Yalidine" >Préparation Yalidine</option>
                                <option value="Livraison Yalidine" >Livraison Yalidine</option>
                                <option value="Vente Magasin" >Vente Magasin</option>
                                <option value="Finale Magasin" >Finale Magasin</option>
                                <option value="Livré" >Livré</option>
                                <option value="Terminer" >Terminer</option>
                                <option value="Récup Magasin">Récup Magasin</option>
                                <option value="Annuler" >Annuler</option>
                                <option value="Échouer" >Échouer</option>
                                <option value="Erreur" >Erreur</option>
                                <option value="Retour" >Retour</option>
                            </select>

                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Prénom<span>*</span></label>
                                    <input class="form-control" type="text" name="first_name" placeholder=""
                                           value="{{old('first_name')}}" value="{{old('first_name')}}" required>
                                    @error('first_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nom<span>*</span></label>
                                    <input class="form-control" type="text" name="last_name" placeholder="" value="{{old('lat_name')}}"
                                           required>
                                    @error('last_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Téléphone<span>*</span></label>
                                    <input class="form-control" type="number" name="phone" placeholder="" required
                                           value="{{old('phone')}}" required>
                                    @error('phone')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 d-none">
                                <div class="form-group">
                                    <label>Country<span>*</span></label>
                                    <select class="form-control" name="country" id="country">
                                        <option value="DZ" selected="selected">Algeria</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group shipping">
                                    <label>Wilaya<span>*</span></label>
                                    <select class="form-control" required name="wilaya" >
                                        <option  disabled selected value hidden>Wilaya</option>
                                        @foreach(Helper::shipping() as $shipping)
                                            <option value="{{$shipping->id}}" class="shippingOption"
                                                    data-price="{{$shipping->price}}">{{$shipping->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Adresse<span>*</span></label>
                                    <input class="form-control" required type="text" name="address1" placeholder=""
                                           value="{{old('address1')}}">
                                    @error('address1')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @foreach($products as $product)
                                    @php
                                        $photo = explode(',', $product->photo)
                                    @endphp
                                    <img class="img-product"  id="{{ $product->id }}" style="display: none" src="{{ asset($photo[0]) }}" alt="" width="200">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-4">
                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop your file Here</span>
                            <input type="file" class="drop-zone__input" name="file_1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop your file Here</span>
                            <input type="file" class="drop-zone__input" name="file_2">
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop your file Here</span>
                            <input type="file" class="drop-zone__input" name="file_3">
                        </div>
                    </div>
                    <div class="col-md-4 pt-5">
                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop your file Here</span>
                            <input type="file" class="drop-zone__input" name="file_4">
                        </div>
                    </div>
                    <div class="col-md-4 pt-5">
                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop your file Here</span>
                            <input type="file" class="drop-zone__input" name="file_5">
                        </div>
                    </div>

                    <div class="col-md-4 pt-5">
                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop your file Here</span>
                            <input type="file" class="drop-zone__input" name="file_6">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function showImage() {
            var x = document.getElementById("product").value;
            $('.img-product').hide();
            $('#' + x).show()
        }


    </script>
    <style>
        .drop-zone {
            max-width: 200px;
            height: 200px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            color: #cccccc;
            border: 4px dashed #009578;
            border-radius: 10px;
        }
        .drop-zone--over {
            border-style: solid;
        }
        .drop-zone__input {
            display: none;
        }
        .drop-zone__thumb {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            background-color: #cccccc;
            background-size: cover;
            position: relative;
        }
        .drop-zone__thumb::after {
            content: attr(data-label);
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 5px 0;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.75);
            font-size: 14px;
            text-align: center;
        }
    </style>
    <script>
        document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
            const dropZoneElement = inputElement.closest(".drop-zone");
            dropZoneElement.addEventListener("click", (e) => {
                inputElement.click();
            });
            inputElement.addEventListener("change", (e) => {
                if (inputElement.files.length) {
                    updateThumbnail(dropZoneElement, inputElement.files[0]);
                }
            });
            dropZoneElement.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropZoneElement.classList.add("drop-zone--over");
            });
            ["dragleave", "dragend"].forEach((type) => {
                dropZoneElement.addEventListener(type, (e) => {
                    dropZoneElement.classList.remove("drop-zone--over");
                });
            });
            dropZoneElement.addEventListener("drop", (e) => {
                e.preventDefault();
                if (e.dataTransfer.files.length) {
                    inputElement.files = e.dataTransfer.files;
                    updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
                }
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });
        function updateThumbnail(dropZoneElement, file) {
            let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
// First time - remove the prompt
            if (dropZoneElement.querySelector(".drop-zone__prompt")) {
                dropZoneElement.querySelector(".drop-zone__prompt").remove();
            }
// First time - there is no thumbnail element, so lets create it
            if (!thumbnailElement) {
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("drop-zone__thumb");
                dropZoneElement.appendChild(thumbnailElement);
            }
            thumbnailElement.dataset.label = file.name;
// Show thumbnail for image files
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => {
                    thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                };
            } else {
                thumbnailElement.style.backgroundImage = null;
            }
        }
    </script>

@endsection

@push('styles')
    <style>
        .order-info,.shipping-info{
            background:#ECECEC;
            padding:20px;
        }
        .order-info h4,.shipping-info h4{
            text-decoration: underline;
        }

    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.shipping select[name=wilaya]').change(function () {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                $('#shipping').val(cost);

            });

        });

    </script>
@endpush

