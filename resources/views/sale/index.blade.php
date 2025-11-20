@extends('layouts.tabler')

@section('contenti')
<div class="page-body">
    @if(!$sales)
    <x-empty
        title="No sales found"
        button_label="{{ __('Add your first Sale') }}"
        button_route="{{ route('sale.create') }}"
    />
    @else
    <div class="container-xl">
        @livewire('tables.sale-table')
    @endif
</div>
@endsection


