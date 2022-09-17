@extends('layouts.main')
@section('container')
<div class="col s12 m12 l6">
    <div class="card">
        <div class="card-content">
            <span class="card-title">Edit Asset</span><br>
                <div class="row">
                    <form class="col s12" method="POST" action="{{ url('assetshistory/'.$model->id) }}">
                        @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <input id="id_stock" type="hidden" class="validate" value="{{ $model->id_stock }}" name="id_stock">
                    <input id="id_transaction" type="hidden" class="validate" value="{{ $model->id_transaction }}" name="id_transaction">
                    <input id="date" type="hidden" class="validate" name="date" value="{{ $model->date }}">
                    
                    <div class="input-field col s12">
                            <input id="material" type="text" class="validate" name="material" value="{{ $model->material }}" placeholder="MATERIAL">
                    </div>
                    <div class="row">
                        <div class="input-field col s1">
                            <input id="qty" type="number" class="validate" name="qty" value="{{ $model->qty }}" placeholder="QTY">
                        </div>
                        <input id="users" type="text" class="validate" name="users" value="AGUSTIAN" hidden>
                        <div class="input-field col s4">
                            <input id="price" type="number" class="validate" name="price" value="{{ $model->price }}" placeholder="PRICE">
                        </div>
                        <div class="input-field col s3">
                            <input id="total_price" type="number" class="validate" name="total_price" value="{{ $model->total_price }}" placeholder="TOTAL PRICE">
                        </div>
                        <div class="input-field col s4">
                            <input id="supplier" type="text" class="validate" name="supplier" value="{{ $model->supplier }}" placeholder="SUPPLIER / STORE">
                        </div>
                    </div>
                
                    <div class="input-field col s12">
                            <input id="desc" type="text" class="validate" name="desc" placeholder="Desc Optional" value="{{ $model->desc }}">
                    </div>

                    <div class="input-field col s4" hidden>
                        <select name="type_asset">
                            <option value="{{ $model->type_asset }}" selected>{{ $model->type_asset }}</option>
                            <option value="ASET TETAP">ASET TETAP</option>
                            <option value="BBM">BBM</option>
                            <option value="BAHAN BAKU">BAHAN BAKU</option>
                        </select>
                        <label>TYPE ASSET</label>
                    </div>
                    <div class="input-field col s5" hidden>
                        <select name="unit">
                            <option value="{{ $model->unit }}" selected>{{ $model->unit }}</option>
                            <option value="PCS">PCS</option>
                            <option value="PACKAGE">PACKAGE</option>
                            <option value="BOX">BOX</option>
                            <option value="LITER">LITER</option>
                            <option value="JERIGEN">JERIGEN</option>
                        </select>
                        <label>UNIT</label>
                    </div>
                    <div class="input-field col s5" hidden>
                        <select name="in_out">
                            <option value="{{ $model->in_out }}" selected>{{ $model->in_out }}</option>
                            <option value="IN">IN</option>
                            <option value="OUT">OUT</option>
                        </select>
                        <label>TYPE ASSET</label>
                    </div>
                    <br>
                    <div class="row">
                        <button class="waves-effect waves-light btn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection