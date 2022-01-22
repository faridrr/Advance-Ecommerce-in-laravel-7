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
          <option value="Commande" {{(($order->status=='Commande')? 'selected' : '')}}>Commande</option>
          <option value="En Fabrication" {{(($order->status=='En Fabrication')? 'selected' : '')}}>En Fabrication</option>
          <option value="Préparation + Livraison Alger" {{(($order->status=='Préparation + Livraison Alger')? 'selected' : '')}}>Préparation + Livraison Alger</option>
          <option value="Préparation + Livraison Yalidine" {{(($order->status=='Préparation + Livraison Yalidine')? 'selected' : '')}}>Préparation + Livraison Yalidine</option>
          <option value="Livré" {{(($order->status=='Livré')? 'selected' : '')}}>Livré</option>
          <option value="Terminer" {{(($order->status=='Terminer')? 'selected' : '')}}>Terminer</option>
          <option value="Récup Magasin" {{(($order->status=='Récup Magasin')? 'selected' : '')}}>Récup Magasin</option>
          <option value="Annuler" {{(($order->status=='Annuler')? 'selected' : '')}}>Annuler</option>
          <option value="Échouer" {{(($order->status=='Échouer')? 'selected' : '')}}>Échouer</option>
          <option value="Erreur" {{(($order->status=='Erreur')? 'selected' : '')}}>Erreur</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
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
