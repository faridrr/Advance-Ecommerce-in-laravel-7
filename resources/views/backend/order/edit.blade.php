@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Order Edit</h5>
  <div class="card-body">
    <form action="{{route('order.update',$order->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Select Status--</option>
          <option value="Prise de commande" {{(($order->status=='Prise de commande')? 'selected' : '')}}>Prise de commande</option>
          <option value="En Fabrication" {{(($order->status=='En Fabrication')? 'selected' : '')}}>En Fabrication</option>
          <option value="Préparation Alger" {{(($order->status=='Préparation Alger')? 'selected' : '')}}>Préparation Alger</option>
          <option value="Livraison Alger" {{(($order->status=='Livraison Alger')? 'selected' : '')}}>Livraison Alger</option>
          <option value="Préparation Yalidine" {{(($order->status=='Préparation Yalidine')? 'selected' : '')}}>Préparation Yalidine</option>
          <option value="Livraison Yalidine" {{(($order->status=='Livraison Yalidine')? 'selected' : '')}}>Livraison Yalidine</option>
            <option value="Vente Magasin" {{(($order->status=='Vente Magasin')? 'selected' : '')}}>Vente Magasin</option>
            <option value="Finale Magasin" {{(($order->status=='Finale Magasin')? 'selected' : '')}}>Finale Magasin</option>
          <option value="Livré" {{(($order->status=='Livré')? 'selected' : '')}}>Livré</option>
          <option value="Terminer" {{(($order->status=='Terminer')? 'selected' : '')}}>Terminer</option>
          <option value="Récup Magasin" {{(($order->status=='Récup Magasin')? 'selected' : '')}}>Récup Magasin</option>
          <option value="Annuler" {{(($order->status=='Annuler')? 'selected' : '')}}>Annuler</option>
          <option value="Échouer" {{(($order->status=='Échouer')? 'selected' : '')}}>Échouer</option>
          <option value="Erreur" {{(($order->status=='Erreur')? 'selected' : '')}}>Erreur</option>
          <option value="Retour" {{(($order->status=='Retour')? 'selected' : '')}}>Retour</option>
        </select>

      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
<div class="card" style="margin: 20px!important;">
    <h5 class="card-header">Order Edit</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('order.updateData', $order->id) }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Prénom<span>*</span></label>
                                <input class="form-control" type="text" name="first_name" placeholder=""
                                        value="{{ $order->first_name }}" required>
                                @error('first_name')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Nom<span>*</span></label>
                                <input class="form-control" type="text" name="last_name" placeholder="" value="{{ $order->last_name }}"
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
                                       value="{{ $order->phone }}" required>
                                @error('phone')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 d-none">
                            <div class="form-group">
                                <label>Country<span>*</span></label>
                                <select class="form-control" name="country" id="country">
                                    <option @if($order->country == 'DZ') selected @endif  value="DZ">Algeria</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group shipping">
                                <label>Wilaya<span>*</span></label>
                                <select class="form-control" required name="shipping_id" >
                                    <option  disabled selected value hidden>Wilaya</option>
                                    @foreach(Helper::shipping() as $shipping)
                                        <option @if($order->shipping_id == $shipping->id) selected @endif  value="{{$shipping->id}}" class="shippingOption"
                                                data-price="{{$shipping->price}}">{{$shipping->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Adresse<span>*</span></label>
                                <input class="form-control" required type="text" name="address1" placeholder=""
                                       value="{{ $order->address1 }}">
                                @error('address1')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 pt-4">
                            <div class="form-group">
                                <button class="form-control btn btn-success" type="submit">Edit</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
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
