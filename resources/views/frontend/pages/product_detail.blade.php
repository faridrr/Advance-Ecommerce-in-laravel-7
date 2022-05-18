@extends('frontend.layouts.master')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
    <meta name="description" content="{{$product_detail->summary}}">
    <meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{$product_detail->title}}">
    <meta property="og:image" content="{{$product_detail->photo}}">
    <meta property="og:description" content="{{$product_detail->description}}">

    <style>
        .shop .nice-select {
            width: 100% !important;
        }
    </style>
@endsection
@section('title','Michket || DÉTAILS DU PRODUIT')
@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Accueil<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{ route('product-grids') }}">Boutique</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shop Single -->
    <section class="shop single section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <!-- Images slider -->
                                <div class="flexslider-thumbnails">
                                    <ul class="slides">
                                        @php
                                            $photo=explode(',',$product_detail->photo);
                                        // dd($photo);
                                        @endphp
                                        @foreach($photo as $key => $data)
                                            <li data-thumb="{{$data}}" rel="adjustX:10, adjustY:">
                                                <img id="image{{ $key }}" src="{{$data}}" alt="{{$data}}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End Images slider -->
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product-des">
                                <!-- Description -->
                                <div class="short">
                                    <h4>{{$product_detail->title}}</h4>

                                    @php
                                        $after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
                                    @endphp
                                    @if($product_detail->discount > 0)
                                        <p class="price"><span
                                                class="discount">{{number_format($after_discount,2)}} DZA</span><s>{{number_format($product_detail->price,2)}}
                                                DZA</s></p>
                                    @else
                                        <p class="price"><span class="discount" id="price">{{number_format($product_detail->price,2)}} DZA</span>
                                        </p>
                                    @endif
                                    <p class="description">{!!($product_detail->summary)!!}</p>
                                </div>
                                <!--/ End Description -->


                                <!--/ End Size -->
                                <!-- Product Buy -->
                                <div class="product-buy">
                                    <form action="{{route('single-add-to-cart')}}" method="POST">
                                        @csrf

                                        <div class="container">
                                            <div class="row">
                                                @if($product_detail->size)
                                                    <div class='col-md-4'>
                                                        <!-- Size -->
                                                        <div class="size mt-4">
                                                            <h4>Taille</h4>
                                                            <ul>
                                                                @php
                                                                    $sizes=explode(',',$product_detail->size);
                                                                @endphp

                                                                @foreach($sizes as $key => $size)
                                                                    <div class="form-check form-check-inline">
                                                                        <input required class="form-check-input"
                                                                               type="radio" name="taille"
                                                                               id="inlineRadio{{ $key }}"
                                                                               value="{{$size}}">
                                                                        <label class="form-check-label"
                                                                               for="inlineRadio{{ $key }}">{{$size}}</label>
                                                                    </div> <br>

                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif


                                                @if(!empty($product_detail->var_blue))
                                                    <div class='col-md-3 col-sm-6'>
                                                        <input type="radio" name="variation" required id="var_blue"
                                                               class="imgbgchk"
                                                               style="opacity: 0; margin: -9px; ; height: 1em;"
                                                               value="var_blue">
                                                        <label for="var_blue">
                                                            <img
                                                                src="{{ asset('michket/public/variations') . '/' .  $product_detail->var_blue }}"
                                                                alt="Image 1" id="var_blue-img">
                                                            <div class="tick_container">
                                                                <div class="tick"><i class="fa fa-check"></i></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(!empty($product_detail->var_red))
                                                    <div class='col-md-3 col-sm-6'>
                                                        <input type="radio" name="variation" required id="var_red"
                                                               class="imgbgchk"
                                                               style="opacity: 0; margin: -9px; ; height: 1em;"
                                                               value="var_red">
                                                        <label for="var_red">
                                                            <img
                                                                src="{{ asset('michket/public/variations') . '/' .  $product_detail->var_red }}"
                                                                alt="Image 2" id="var_red-img">
                                                            <div class="tick_container">
                                                                <div class="tick"><i class="fa fa-check"></i></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(!empty($product_detail->var_white))
                                                    <div class='col-md-3 col-sm-6'>
                                                        <input type="radio" name="variation" required id="var_white"
                                                               class="imgbgchk"
                                                               style="opacity: 0; margin: -9px; ; height: 1em;"
                                                               value="var_white">
                                                        <label for="var_white">
                                                            <img
                                                                src="{{ asset('michket/public/variations') . '/' .  $product_detail->var_white }}"
                                                                alt="Image 3" id="var_white-img">
                                                            <div class="tick_container">
                                                                <div class="tick"><i class="fa fa-check"></i></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(!empty($product_detail->var_pink))
                                                    <div class='col-md-3 col-sm-6'>
                                                        <input type="radio" name="variation" required id="var_pink"
                                                               class="imgbgchk"
                                                               style="opacity: 0; margin: -9px; ; height: 1em;"
                                                               value="var_pink">
                                                        <label for="var_pink">
                                                            <img
                                                                src="{{ asset('michket/public/variations') . '/' .  $product_detail->var_pink }}"
                                                                alt="Image 3" id="var_pink-img">
                                                            <div class="tick_container">
                                                                <div class="tick"><i class="fa fa-check"></i></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(!empty($product_detail->var_green))
                                                    <div class='col-md-3 col-sm-6'>
                                                        <input type="radio" name="variation" required id="var_green"
                                                               class="imgbgchk"
                                                               style="opacity: 0; margin: -9px; ; height: 1em;"
                                                               value="var_green">
                                                        <label for="var_green">
                                                            <img
                                                                src="{{ asset('michket/public/variations') . '/' .  $product_detail->var_green }}"
                                                                alt="Image 3" id="var_green-img">
                                                            <div class="tick_container">
                                                                <div class="tick"><i class="fa fa-check"></i></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(!empty($product_detail->var_orange))
                                                    <div class='col-md-3 col-sm-6'>
                                                        <input type="radio" name="variation" required id="var_orange"
                                                               class="imgbgchk"
                                                               style="opacity: 0; margin: -9px; ; height: 1em;"
                                                               value="var_orange">
                                                        <label for="var_orange">
                                                            <img
                                                                src="{{ asset('michket/public/variations') . '/' .  $product_detail->var_orange }}"
                                                                alt="Image 3" id="var_orange-img">
                                                            <div class="tick_container">
                                                                <div class="tick"><i class="fa fa-check"></i></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(!empty($product_detail->var_yellow))
                                                    <div class='col-md-3 col-sm-6'>
                                                        <input type="radio" name="variation" required id="var_yellow"
                                                               class="imgbgchk"
                                                               style="opacity: 0; margin: -9px; ; height: 1em;"
                                                               value="var_yellow">
                                                        <label for="var_yellow">
                                                            <img
                                                                src="{{ asset('michket/public/variations') . '/' .  $product_detail->var_yellow }}"
                                                                alt="Image 3" id="var_yellow-img">
                                                            <div class="tick_container">
                                                                <div class="tick"><i class="fa fa-check"></i></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="quantity">
                                            <h6>Quantité :</h6>
                                            <!-- Input Order -->
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                            disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                                                <input type="text" name="quant[1]" class="input-number" data-min="1"
                                                       data-max="1000" value="1" id="quantity">
                                                <div class="button plus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                            data-type="plus" data-field="quant[1]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--/ End Input Order -->
                                        </div>

                                        @if(isset($product_detail->price_customize))
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group m-2 p-2">
                                                            <input class="form-check-input " name="customize"
                                                                   type="checkbox" value="true" id="customize">
                                                            <label class="form-check-label" for="customize">
                                                                Voulez vous personnaliser le texte ?
                                                            </label>
                                                        </div>
                                                        <div class="form-group" id="type_group" style="display: none">
                                                            <label for="type_group">Choisissez le type de
                                                                personnalisation :</label>
                                                            <select name="type" id="type" class="form-control">
                                                                <option value="logo">Logo</option>
                                                                <option value="personalized">Personalisé</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group" id="text_group" style="display: none">
                                                            <label for="text">Saisissez votre texte :</label>
                                                            <br>
                                                            <input type="text" name="text" id="text"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group" id="option_group" style="display: none">
                                                            <label for="option">Option supplementaire <span
                                                                    style="color: #727b84">(Police, Taille ...)</span></label>
                                                            <br>
                                                            <textarea name="options" id="option" cols="30" rows="2"
                                                                      class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group" id="file_group" style="display: none">
                                                            <input type="file" name="personalized_file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="add-to-cart mt-4">
                                            <button type="submit" class="btn">Commander</button>
                                        </div>
                                    </form>


                                    <p class="availability">Stock : @if($product_detail->stock>0)<span
                                            class="badge badge-success">{{$product_detail->stock}}</span>@else <span
                                            class="badge badge-danger">{{$product_detail->stock}}</span>  @endif</p>
                                </div>
                                <!--/ End Product Buy -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-info">
                                <div class="nav-main">
                                    <!-- Tab Nav -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                                href="#description" role="tab">Description</a></li>
                                    </ul>
                                    <!--/ End Tab Nav -->
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <!-- Description Tab -->
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="single-des">
                                                        <p>{!! ($product_detail->description) !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Description Tab -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Shop Single -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Produits Similaires</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- {{$product_detail->rel_prods}} --}}
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                    @foreach($product_detail->rel_prods as $data)
                        @if($data->id !==$product_detail->id)
                            <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{route('product-detail',$data->slug)}}">
                                            @php
                                                $photo=explode(',',$data->photo);
                                            @endphp
                                            <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                            <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                            <span class="price-dec">{{$data->discount}} % Off</span>
                                            {{-- <span class="out-of-stock">Hot</span> --}}
                                        </a>
                                        <div class="button-head">
                                            <div class="product-action">
                                                <a data-toggle="modal" data-target="#modelExample" title="Quick View"
                                                   href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                            </div>
                                            <div class="product-action-2">
                                                <a title="Add to cart" href="#">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>
                                        <div class="product-price">
                                            @php
                                                $after_discount=($data->price-(($data->discount*$data->price)/100));
                                            @endphp
                                            <span class="old">{{number_format($data->price,2)}} DZA</span>
                                            <span>{{number_format($after_discount,2)}} DZA</span>
                                        </div>

                                    </div>
                                </div>
                                <!-- End Single Product -->

                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->


    <!-- Modal -->
    <div class="modal fade" id="modelExample" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                                                                                                      aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    <div class="single-slider">
                                        <img src="images/modal1.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal2.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal3.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal4.png" alt="#">
                                    </div>
                                </div>
                            </div>
                            <!-- End Product slider -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

@endsection
@push('styles')
    <style>
        /* Rating */
        .rating_box {
            display: inline-flex;
        }

        .star-rating {
            font-size: 0;
            padding-left: 10px;
            padding-right: 10px;
        }

        .star-rating__wrap {
            display: inline-block;
            font-size: 1rem;
        }

        .star-rating__wrap:after {
            content: "";
            display: table;
            clear: both;
        }

        .star-rating__ico {
            float: right;
            padding-left: 2px;
            cursor: pointer;
            color: #fab615;
            font-size: 16px;
            margin-top: 5px;
        }

        .star-rating__ico:last-child {
            padding-left: 0;
        }

        .star-rating__input {
            display: none;
        }

        .star-rating__ico:hover:before,
        .star-rating__ico:hover ~ .star-rating__ico:before,
        .star-rating__input:checked ~ .star-rating__ico:before {
            content: "\F005";
        }

        html, body {
            min-height: 100vh;
            min-width: 100vw;
        }

        .parent {
            height: 100vh;
        }

        .parent > .row {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .col-md-3 img {
            height: 80px;
            width: 100%;
            cursor: pointer;
            transition: transform 1s;
            object-fit: cover;
        }

        .col-md-3 label {
            overflow: hidden;
            position: relative;
        }

        .imgbgchk:checked + label > .tick_container {
            opacity: 1;
        }

        /*         aNIMATION */
        .imgbgchk:checked + label > img {
            transform: scale(1.25);
            opacity: 0.3;
        }

        .tick_container {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            cursor: pointer;
            text-align: center;
        }

        .tick {
            background-color: #fab615;
            color: white;
            font-size: 16px;
            padding: 6px 12px;
            height: 40px;
            width: 40px;
            border-radius: 100%;
        }


    </style>

@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    @if($product_detail->discount > 0)
        <p class="price" id="price_dis">
            <span class="discount">{{number_format($after_discount,2)}} DZA</span>
            <s>{{number_format($product_detail->price,2)}}DZA</s></p>
    @else
        <p class="price"><span class="discount" id="price">{{number_format($product_detail->price,2)}} DZA</span></p>
    @endif
    @if(isset($product_detail->price_customize))
        <script>
            $('input:radio').change(
                function () {
                    $('#image0').attr('src', $('#' + $(this).first().attr('id') + '-img').prop('src'));

                }
            )

            $(document).ready(function () {
                $('#customize').change(function () {
                    if (this.checked) {
                        $('#text_group').show()
                        $('#option_group').show()
                        $('#type_group').show()
                        $('#file_group').show()

                        if ({{$product_detail->discount }} > 0)
                        {
                            $("#price_dis").html("<span class=\"discount\" >{{number_format($after_discount,2)}} DZA</span>\n" +
                                "            <s>{{number_format($product_detail->price_logo,2)}}DZA</s>");
                        }
                    else
                        {
                            $("#price").html("{{number_format($product_detail->price_logo,2)}} DZA");
                        }

                    } else {
                        $('#text_group').hide()
                        $('#option_group').hide()
                        $('#type_group').hide()
                        $('#file_group').hide()

                        if ({{$product_detail->discount }} >
                        0
                    )
                        {
                            $("#price_dis").html("<span class=\"discount\" >{{number_format($after_discount,2)}} DZA</span>\n" +
                                "            <s>{{number_format($product_detail->price,2)}}DZA</s>");
                        }
                    else
                        {
                            $("#price").html("{{number_format($product_detail->price,2)}} DZA");
                        }
                    }
                });

                $('#type').change(function () {
                    if ($('#customize').is(":checked")) {

                        if (this.value == 'personalized') {
                            if ({{$product_detail->discount }} > 0 )
                            {
                                $("#price_dis").html("<span class=\"discount\" >{{number_format($after_discount,2)}} DZA</span>\n" +
                                    "            <s>{{number_format($product_detail->price_customize,2)}}DZA</s>");
                            }
                        else
                            {
                                $("#price").html("{{number_format($product_detail->price_customize,2)}} DZA");
                            }
                        } else {
                            if ({{$product_detail->discount }} >
                            0
                        )
                            {
                                $("#price_dis").html("<span class=\"discount\" >{{number_format($after_discount,2)}} DZA</span>\n" +
                                    "            <s>{{number_format($product_detail->price_logo,2)}}DZA</s>");
                            }
                        else
                            {
                                $("#price").html("{{number_format($product_detail->price_logo,2)}} DZA");
                            }

                        }

                    }
                });


            });


        </script>
    @endif
    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}

@endpush
