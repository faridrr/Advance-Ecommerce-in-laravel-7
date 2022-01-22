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
                <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
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
                      <td>{{ $cart->variation }} {{ $cart->taille }}</td>
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
                        <td> : {{$order->created_at->format('D d M, Y')}} at {{$order->created_at->format('g : i a')}} </td>
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
                        <td> : @if($order->payment_method=='cod') Cash on Delivery @else Paypal @endif</td>
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
                        <td> : {{$order->shipping->type}}, {{$order->address1}}, {{$order->address2}}</td>
                    </tr>

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
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
