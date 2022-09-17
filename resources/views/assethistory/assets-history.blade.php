@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col s12">
            <div class="page-title"><a style="font-weight: bold;">ASSET </a>| ASSET HISTORY</div>
        </div>
        <div class="col s12 m12 l12">
            <div class="card">
                <div class="card-content">
                    <div class="col s12 m12 l12" align="left">
                        <input type="text" class="expand-search"  placeholder="Search History" autocomplete="off">
                    </div>
                    <table class="striped" style="margin-top: 2%;">
                        <thead style="font-size: 12px;">
                            <tr>
                                <th class="center">NO</th>
                                <th class="center" >ID ASSET</th>
                                <th class="center">ID TRANSACTION</th>
                                <th class="center">DATE</th>
                                <th class="center">MATERIAL</th>
                                <th class="center">QTY</th>
                                <th class="center">UNIT</th>
                                <th class="center">PRICE</th>
                                <th class="center">TOTAL PRICE</th>
                                <th class="center">USER</th>
                                <th class="center">DESC</th>
                                <th class="center">TYPE ASSET</th>
                                <th class="center">STOCK</th>
                                <th class="center">SUPPLIER</th>
                                <th class="center">ACT</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 11px;">
                            @foreach ($datas as $key=>$value)
                            <tr>
                                <td class="center" style="font-weight: bold;">{{ ++$key }}</td>
                                <td class="center" style="font-weight: bold;">{{ $value->id_stock }}</td>
                                <td class="center" style="font-weight: bold;">{{ $value->id_transaction }}</td>
                                <td class="center" style="font-weight: bold;">{{ $value->date }}</td>
                                <td class="center" style="font-weight: bold;">{{ $value->material }}</td>
                                <td class="center" style="font-weight: bold;">{{ $value->qty }}</td>
                                <td class="center" style="font-weight: bold;">{{ $value->unit }}</td>
                                <td class="center" style="font-weight: bold;">{{ currency_IDR($value->price) }}</td>
                                <td class="center" style="font-weight: bold;">{{ currency_IDR($value->total_price) }}</td>
                                <td class="center" style="font-weight: bold;">{{ $value->users }}</td>
                                <td class="center" style="font-weight: bold;">{{ $value->desc }}</td>

                                @if ($value->type_asset === "BBM")
                                <td class="center" style="font-weight: bold;"> <a style="color: green;">{{ $value->type_asset }}</a></td>
                                @endif

                                @if ($value->type_asset === "BAHAN BAKU")
                                <td class="center" style="font-weight: bold;"> <a style="color: rgb(255, 94, 0);">{{ $value->type_asset }}</a></td>
                                @endif

                                @if ($value->type_asset === "ASET TETAP")
                                <td class="center" style="font-weight: bold;"> <a style="color: rgb(0, 191, 255);">{{ $value->type_asset }}</a></td>
                                @endif
                                
                                @if ($value->in_out === "IN")
                                <td class="center" style="font-weight: bold;"><a class="btn-floating btn waves-effect waves-light green">{{ $value->in_out }}</a></td>
                                @else
                                <td class="center" style="font-weight: bold;"><a class="btn-floating btn waves-effect waves-light red">{{ $value->in_out }}</a></td>
                                @endif
                               
                                <td class="center" style="font-weight: bold;">{{ $value->supplier }}</td>
                                <td class="center">
                                    <span><a class="btn-floating btn waves-effect waves-light blue" href="{{ url('/edit'.'/'.$value->id) }}"><i class="material-icons">description</i></a>
                                        <a class="btn-floating btn waves-effect waves-light red"><i class="material-icons">delete</i></a>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
@endsection