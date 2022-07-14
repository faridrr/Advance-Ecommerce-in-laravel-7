@extends('frontend.layouts.master')

@section('title','Michket || BOUTIQUE')

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
                            @if(isset($category))
                                @if($category->is_parent)
                                <li class="active"><a href="{{route('product-grids',$category->slug)}}"><i class="ti-arrow-right"></i>{{ $category->title }}</a></li>
                                @else
                                @php
                                    $category_1 =  \App\Models\Category::where('id',$category->parent_id )->first()
                                @endphp
                                    @if($category_1->is_parent)
                                        <li class="active"><a href="{{route('product-grids',$category_1->slug)}}"><i class="ti-arrow-right"></i>{{ $category_1->title }}</a></li>
                                        <li class="active"><a href="{{route('product-grids',$category->slug)}}"><i class="ti-arrow-right"></i>{{ $category->title }}</a></li>
                                    @else
                                        @php
                                            $category_2 =  \App\Models\Category::where('id',$category_1->parent_id )->first()
                                        @endphp
                                        @if($category_2->is_parent)
                                            <li class="active"><a href="{{route('product-grids',$category_2->slug)}}"><i class="ti-arrow-right"></i>{{ $category_2->title }}</a></li>
                                            <li class="active"><a href="{{route('product-grids',$category_1->slug)}}"><i class="ti-arrow-right"></i>{{ $category_1->title }}</a></li>
                                            <li class="active"><a href="{{route('product-grids',$category->slug)}}"><i class="ti-arrow-right"></i>{{ $category->title }}</a></li>
                                        @else
                                            @php
                                                $category_3 =  \App\Models\Category::where('id',$category_2->parent_id )->first()
                                            @endphp
                                            @if($category_3->is_parent)
                                                <li class="active"><a href="{{route('product-grids',$category_3->slug)}}"><i class="ti-arrow-right"></i>{{ $category_3->title }}</a></li>
                                                <li class="active"><a href="{{route('product-grids',$category_2->slug)}}"><i class="ti-arrow-right"></i>{{ $category_2->title }}</a></li>
                                                <li class="active"><a href="{{route('product-grids',$category_1->slug)}}"><i class="ti-arrow-right"></i>{{ $category_1->title }}</a></li>
                                                <li class="active"><a href="{{route('product-grids',$category->slug)}}"><i class="ti-arrow-right"></i>{{ $category->title }}</a></li>
                                            @else
                                                @php
                                                    $category_4 =  \App\Models\Category::where('id',$category_3->parent_id )->first()
                                                @endphp
                                                <li class="active"><a href="{{route('product-grids',$category_4->slug)}}"><i class="ti-arrow-right"></i>{{ $category_4->title }}</a></li>
                                                <li class="active"><a href="{{route('product-grids',$category_3->slug)}}"><i class="ti-arrow-right"></i>{{ $category_3->title }}</a></li>
                                                <li class="active"><a href="{{route('product-grids',$category_2->slug)}}"><i class="ti-arrow-right"></i>{{ $category_2->title }}</a></li>
                                                <li class="active"><a href="{{route('product-grids',$category_1->slug)}}"><i class="ti-arrow-right"></i>{{ $category_1->title }}</a></li>
                                                <li class="active"><a href="{{route('product-grids',$category->slug)}}"><i class="ti-arrow-right"></i>{{ $category->title }}</a></li>
                                            @endif

                                        @endif
                                    @endif

                                @endif
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->

        @isset($menu)
        <section class="product-area shop-sidebar shop section">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="row">

                            @foreach($menu as $cat_info)
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{route('product-grids',$cat_info->slug)}}">
                                                <img class="default-img" src="{{$cat_info->photo}}" alt="{{$cat_info->photo}}">
                                                <img  class="hover-img" src="{{$cat_info->photo}}" alt="{{$cat_info->photo}}">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <h3>
                                                <a href="{{route('product-grids',$cat_info->slug)}}">{{$cat_info->title}}</a>
                                            </h3>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>


                    </div>
                </div>
            </div>
        </section>
        @endisset
        @isset($products)
            <!-- Product Style -->
            <form action="{{Request::url()}}" method="POST">
                @csrf
                <section class="product-area shop-sidebar shop section">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Shop Top -->
                                <div class="shop-top">
                                    <div class="shop-shorter">
                                        <div class="single-shorter">
                                            <label>Trier par :</label>
                                            <select class='sortBy' name='sortBy' onchange="this.form.submit();">
                                                <option value="">Par Défaut</option>
                                                <option value="title"
                                                        @if(!empty($request['sortBy']) && $request['sortBy']=='title') selected @endif>
                                                    Nom
                                                </option>
                                                <option value="price"
                                                        @if(!empty($request['sortBy']) && $request['sortBy']=='price') selected @endif>
                                                    Prix
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Shop Top -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    @if(count($products)>0)
                                        @foreach($products as $product)
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        <a href="{{route('product-detail',$product->slug)}}">
                                                            @php
                                                                $photo=explode(',',$product->photo);
                                                        @endphp
                                                        <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                        <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                        @if($product->discount)
                                                            <span class="price-dec">{{$product->discount}} % Off</span>
                                                        @endif
                                                    </a>
                                                    <div class="button-head">
                                                        <div class="product-action">
                                                            <a title="Acheter" href="{{route('product-detail',$product->slug)}}"><i class=" ti-eye"></i><span>Achat rapide</span></a>
                                                        </div>
                                                        <div class="product-action-2">
                                                            <a title="Acheter"
                                                               href="{{route('product-detail',$product->slug)}}">Acheter</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3>
                                                        <a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a>
                                                    </h3>
                                                    @php
                                                        $after_discount=($product->price-($product->price*$product->discount)/100);
                                                    @endphp
                                                    <span>{{number_format($after_discount,2)}} DZD</span>
                                                    <del style="padding-left:4%;">{{number_format($product->price,2)}}DZD
                                                    </del>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h4 class="text-warning" style="margin:100px auto;">Il n'y a pas de produits.</h4>
                                @endif


                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </form>

    @endisset

@endsection
@push('styles')
    <style>
        .pagination {
            display: inline-flex;
        }

        .filter_button {
            /* height:20px; */
            text-align: center;
            background: #fab615;
            padding: 8px 16px;
            margin-top: 10px;
            color: white;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
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
							// document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}
    <script>
        $(document).ready(function () {
            /*----------------------------------------------------*/
            /*  Jquery Ui slider js
            /*----------------------------------------------------*/
            if ($("#slider-range").length > 0) {
                const max_value = parseInt($("#slider-range").data('max')) || 500;
                const min_value = parseInt($("#slider-range").data('min')) || 0;
                const currency = $("#slider-range").data('currency') || '';
                let price_range = min_value + '-' + max_value;
                if ($("#price_range").length > 0 && $("#price_range").val()) {
                    price_range = $("#price_range").val().trim();
                }

                let price = price_range.split('-');
                $("#slider-range").slider({
                    range: true,
                    min: min_value,
                    max: max_value,
                    values: price,
                    slide: function (event, ui) {
                        $("#amount").val(currency + ui.values[0] + " -  " + currency + ui.values[1]);
                        $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                    }
                });
            }
            if ($("#amount").length > 0) {
                const m_currency = $("#slider-range").data('currency') || '';
                $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                    "  -  " + m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script>
@endpush
