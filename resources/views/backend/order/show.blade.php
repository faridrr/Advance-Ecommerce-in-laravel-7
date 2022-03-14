@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
    <div class="card">
        <h5 class="card-header">Order
        </h5>
        <div class="card-body">
            @if($order)
                <table class="table table-striped table-hover">
                    @php
                        $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                    @endphp
                    <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Charge</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order->order_number}}-{{$order->first_name}}-{{$order->last_name}}</td>
                        <td>{{$order->first_name}} {{$order->last_name}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>@foreach($shipping_charge as $data) {{number_format($data,2)}} DZD @endforeach</td>
                        <td>{{number_format($order->total_amount,2)}} DZD</td>
                        <td>
                            @if($order->status=='Commande')
                                <span class="badge badge-success">{{$order->status}}</span>
                            @elseif($order->status=='En Fabrication')
                                <span class="badge badge-warning">{{$order->status}}</span>
                            @elseif($order->status=='Préparation + Livraison Alger')
                                <span class="badge badge-primary">{{$order->status}}</span>
                            @elseif($order->status=='Préparation + Livraison Yalidine')
                                <span class="badge badge-info">{{$order->status}}</span>
                            @elseif($order->status=='Livré')
                                <span class="badge badge-dark">{{$order->status}}</span>
                            @elseif($order->status=='Terminer')
                                <span class="badge badge-secondary">{{$order->status}}</span>
                            @elseif($order->status=='Récup Magasin')
                                <span class="badge badge-light">{{$order->status}}</span>
                            @elseif($order->status=='Annuler')
                                <span class="badge badge-danger">{{$order->status}}</span>
                            @elseif($order->status=='Échouer')
                                <span class="badge badge-danger">{{$order->status}}</span>
                            @elseif($order->status=='Erreur')
                                <span class="badge badge-danger">{{$order->status}}</span>
                            @else
                                <span class="badge badge-danger">{{$order->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1"
                               style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                               data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px;
                                        width:30px;border-radius:50%
                                " data-toggle="tooltip" data-placement="bottom" title="Delete"><i
                                    class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>

                    </tr>
                    </tbody>
                </table>


                @php
                    $carts = \App\Models\Cart::where('user_id',$order->user_id)->where('order_id' , $order->id)->get();
                @endphp

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td>
                                @php
                                    $photo=explode(',',$cart->product['photo']);
                                @endphp
                                <img src="{{$photo[0]}}" width="70">
                            </td>
                            <td>{{ $cart->product->title }}</td>
                            <td>{{number_format($cart['price'],2)}} DZA</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{$cart['amount']}} DZA</td>
                            <td>
                                @if( $cart->variation != null)
                                    {{ $cart->variation }}
                                    <br>
                                @endif
                                @if( $cart->taille != null)
                                    {{ $cart->taille }}
                                    <br>
                                @endif
                                @if($cart->text != null || $cart->options != null)
                                    <strong class="badge-danger p-1">Personaliser</strong>
                                    <br>
                                    {{ $cart->text }}
                                    <br>
                                    {{ $cart->options }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                        <div class="row">
                            <div class="col-lg-6 col-lx-4">
                                <div class="order-info">
                                    <h4 class="text-center pb-4">ORDER INFORMATION</h4>
                                    <table class="table">
                                        <tr class="">
                                            <td>Order Number</td>
                                            <td> : {{$order->order_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>Order Date</td>
                                            <td> : {{$order->created_at->format('D d M, Y')}}
                                                at {{$order->created_at->format('g : i a')}} </td>
                                        </tr>
                                        <tr>
                                            <td>Quantity</td>
                                            <td> : {{$order->quantity}}</td>
                                        </tr>
                                        <tr>
                                            <td>Order Status</td>
                                            <td> : {{$order->status}}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                                            @endphp
                                            <td>Shipping Charge</td>
                                            <td> : {{number_format($shipping_charge[0],2)}} DZD</td>
                                        </tr>
                                        <tr>
                                            <td>Coupon</td>
                                            <td> : {{number_format($order->coupon,2)}} DZD</td>
                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td> : {{number_format($order->total_amount,2)}} DZD</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td> : @if($order->payment_method=='cod') Cash on Delivery @else
                                                    Paypal @endif</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lx-4">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                                    <table class="table">
                                        <tr class="">
                                            <td>Full Name</td>
                                            <td> : {{$order->first_name}} {{$order->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone No.</td>
                                            <td> : {{$order->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td> : {{$order->shipping->type}}, {{$order->address1}}
                                                , {{$order->address2}}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="confirmation_part section_padding pt-5">
                    <div class="order_boxes">
                        <div class="row">
                            <div class="col-lg-6 col-lx-4">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                                    <table class="table">
                                        @if(isset($order->pri_commande))
                                            <tr class="">
                                                <td>Prise de commande</td>
                                                <td> : {{$order->pri_commande}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->fabrication))
                                            <tr class="">
                                                <td>En Fabrication</td>
                                                <td> : {{$order->fabrication}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->pre_alger))
                                            <tr class="">
                                                <td>Préparation Alger</td>
                                                <td> : {{$order->pre_alger}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->liv_alger))
                                            <tr class="">
                                                <td>Préparation Yalidine</td>
                                                <td> : {{$order->liv_alger}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->pre_yalidine))
                                            <tr class="">
                                                <td>Livraison Yalidine</td>
                                                <td> : {{$order->pre_yalidine}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->liv_yalidine))
                                            <tr class="">
                                                <td>Full Name</td>
                                                <td> : {{$order->liv_yalidine}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->vente_magasin))
                                            <tr class="">
                                                <td>Vente Magasin</td>
                                                <td> : {{$order->vente_magasin}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->finale_magasin))
                                            <tr class="">
                                                <td>Finale Magasin</td>
                                                <td> : {{$order->finale_magasin}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->livre))
                                            <tr class="">
                                                <td>Livré</td>
                                                <td> : {{$order->livre}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->terminer))
                                            <tr class="">
                                                <td>Terminer</td>
                                                <td> : {{$order->terminer}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->récup_magasin))
                                            <tr class="">
                                                <td>Récup Magasin</td>
                                                <td> : {{$order->récup_magasin}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->annuler))
                                            <tr class="">
                                                <td>Annuler</td>
                                                <td> : {{$order->annuler}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->echouer))
                                                <tr class="">
                                                    <td>Échouer</td>
                                                    <td> : {{$order->echouer}}</td>
                                                </tr>
                                            @endif
                                        @if(isset($order->erreur))
                                            <tr class="">
                                                <td>Erreur</td>
                                                <td> : {{$order->erreur}}</td>
                                            </tr>
                                        @endif
                                        @if(isset($order->retour))
                                            <tr class="">
                                                <td>Retour</td>
                                                <td> : {{$order->retour}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lx-4">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                                    <table class="table">
                                        @isset($order->file_1)
                                        <tr class="">
                                            <td>File 1</td>
                                            <td> : <a target="_blank" href="{{ asset('orders') . '/'. $order->file_1 }}">{{ $order->file_1 }}</a></td>
                                        </tr>
                                        @endisset
                                        @isset($order->file_2)
                                        <tr class="">
                                            <td>File 2</td>
                                            <td> : <a target="_blank" href="{{ asset('orders') . '/'. $order->file_2 }}">{{ $order->file_2 }}</a></td>
                                        </tr>
                                            @endisset
                                            @isset($order->file_3)
                                        <tr class="">
                                            <td>File 3</td>
                                            <td> : <a target="_blank" href="{{ asset('orders') . '/'. $order->file_3 }}">{{ $order->file_3 }}</a></td>
                                        </tr>
                                            @endisset
                                            @isset($order->file_4)
                                        <tr class="">
                                            <td>File 4</td>
                                            <td> : <a target="_blank" href="{{ asset('orders') . '/'. $order->file_4 }}">{{ $order->file_4 }}</a></td>
                                        </tr>
                                            @endisset
                                            @isset($order->file_5)
                                        <tr class="">
                                            <td>File 5</td>
                                            <td> : <a target="_blank" href="{{ asset('orders') . '/'. $order->file_5 }}">{{ $order->file_5 }}</a></td>
                                        </tr>
                                            @endisset
                                            @isset($order->file_6)
                                        <tr class="">
                                            <td>File 6</td>
                                            <td> : <a target="_blank" href="{{ asset('orders') . '/'. $order->file_6 }}">{{ $order->file_6 }}</a></td>
                                        </tr>
                                            @endisset
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info, .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4, .shipping-info h4 {
            text-decoration: underline;
        }

    </style>
@endpush
