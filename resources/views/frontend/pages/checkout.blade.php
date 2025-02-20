@extends('frontend.layouts.master')

@section('title','Page de Commande')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Commande</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <form class="form" method="POST" action="{{route('cart.order')}}">
                @csrf
                <div class="row">

                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>Faites votre commande ici</h2>
                            <p>Veuillez entrer vos coordonnées</p>
                            <!-- Form -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Prénom<span>*</span></label>
                                        <input type="text" name="first_name" placeholder=""
                                               value="{{old('first_name')}}" value="{{old('first_name')}}" required>
                                        @error('first_name')
                                        <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Nom<span>*</span></label>
                                        <input type="text" name="last_name" placeholder="" value="{{old('lat_name')}}"
                                               required>
                                        @error('last_name')
                                        <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Téléphone<span>*</span></label>
                                        <input type="number" name="phone" placeholder="" required
                                               value="{{old('phone')}}" required>
                                        @error('phone')
                                        <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 d-none">
                                    <div class="form-group">
                                        <label>Country<span>*</span></label>
                                        <select name="country" id="country">
                                            <option value="DZ" selected="selected">Algeria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group shipping">
                                        <label>Wilaya<span>*</span></label>
                                        <select required name="shipping" class="nice-select">
                                            <option disabled selected value hidden>Wilaya</option>
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
                                        <input required type="text" name="address1" placeholder=""
                                               value="{{old('address1')}}">
                                        @error('address1')
                                        <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <!--/ End Form -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Commande Totale</h2>
                                <div class="content">
                                    <ul>
                                        <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Sous-total
                                            du panier<span>{{number_format(Helper::totalCartPrice(),2)}} DZA</span></li>
                                        <li class="shipping">
                                            Frais de Livraison
                                            @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                                <span id="order_shipping_price"></span>

                                            @else
                                                <span>Gratuit</span>
                                            @endif
                                        </li>

                                        @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['value']}}">Vous
                                                économisez<span>{{number_format(session('coupon')['value'],2)}} DZA</span>
                                            </li>
                                        @endif
                                        @php
                                            $total_amount=Helper::totalCartPrice();
                                            if(session('coupon')){
                                                $total_amount=$total_amount-session('coupon')['value'];
                                            }
                                        @endphp
                                        @if(session('coupon'))
                                            <li class="last" id="order_total_price">Total<span>{{number_format($total_amount,2)}} DZA</span>
                                            </li>
                                        @else
                                            <li class="last" id="order_total_price">Total<span>{{number_format($total_amount,2)}} DZA</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Paiements</h2>
                                <div class="content">
                                    <div class="checkbox">
                                        {{-- <label class="checkbox-inline" for="1"><input name="updates" id="1" type="checkbox"> Check Payments</label> --}}
                                        <form-group>
                                            <input checked name="payment_method" type="radio" value="cod"> <label>Paiement
                                                à la livraison</label><br>
                                        </form-group>

                                    </div>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Button Widget -->
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <button type="submit" class="btn">Commander</button>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Button Widget -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/ End Checkout -->

    <!-- Start Shop Services Area  -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services -->


@endsection
@push('styles')
    <style>
        li.shipping {
            display: inline-flex;
            width: 100%;
            font-size: 14px;
        }

        li.shipping .input-group-icon {
            width: 100%;
            margin-left: 10px;
        }

        .input-group-icon .icon {
            position: absolute;
            left: 20px;
            top: 0;
            line-height: 40px;
            z-index: 3;
        }

        .form-select {
            height: 30px;
            width: 100%;
        }

        .form-select .nice-select {
            border: none;
            border-radius: 0px;
            height: 40px;
            background: #f6f6f6 !important;
            padding-left: 45px;
            padding-right: 40px;
            width: 100%;
        }

        .list li {
            margin-bottom: 0 !important;
        }

        .list li:hover {
            background: #fab615 !important;
            color: white !important;
        }

        .form-select .nice-select::after {
            top: 14px;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("select.select2").select2();
        });
        $('select.nice-select').niceSelect();
    </script>
    <script>
        function showMe(box) {
            var checkbox = document.getElementById('shipping').style.display;
            // alert(checkbox);
            var vis = 'none';
            if (checkbox == "none") {
                vis = 'block';
            }
            if (checkbox == "block") {
                vis = "none";
            }
            document.getElementById(box).style.display = vis;
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.shipping select[name=shipping]').change(function () {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                // alert(coupon);
                $('#order_total_price span').text((subtotal + cost - coupon).toFixed(2) + ' DZA');
                $('#order_shipping_price').text((cost).toFixed(2) + ' DZA');
            });

        });

    </script>

@endpush
