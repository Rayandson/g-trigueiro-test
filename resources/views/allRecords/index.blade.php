@extends('layouts.app')

@section('content')
<div class="records-page-container">
    <div class="content">
        <div class="records-div">
                <h1 class="records-page-title">Todos os registros</h1>
            <div class="records-wrapper">
                @if($records->count())
                @foreach ($records as $record )
                <div class="record-container">
                    <div class="record-main-content">
                        <a href="{{ asset("storage/" . $record->image_path) }}">
                            <img class="screen-img" src="{{ asset("storage/" . $record->image_path) }}" alt="Image">
                        </a>
                        {{-- <img class="screen-img" src="{{ $record->image_path }}" alt=""> --}}
                        <div class="info-div">
                            <div class="main-info-div">
                                <p class="debtor">Devedor: {{ $record->debtor->name }}</p>
                                @if($record->hasSoda)
                                <p class="debt">A pagar: 1 Pizza + 1 Refrigerante</p>
                                @else
                                <p>A pagar: 1 Pizza</p>
                                @endif
                            </div>
                            <p class="date">Data: {{ $record->created_at->toDateString() }}</p>
                        </div>
                    </div>
                    <div class="status-div">
                        @if($record->is_paid == true)
                        <div class="status-paid">
                            <ion-icon class="checkmark" name="checkmark"></ion-icon>
                            <p>Pago</p>
                        </div>
                        @else
                        <div class="status-pending">
                            <ion-icon class="timer" name="time-outline"></ion-icon>
                            <p>Pagamento pendente</p>
                        </div>
                        @endif
                        @if($record->is_paid == false && auth()->user()->role == "admin")
                        <form class="confirmation-form" action="{{ route('updateRecordStatus') }}" method="POST">
                            @csrf
                            <input type="hidden" name="record_id" value="{{ $record->id }}">
                            <button type="submit" class="confirm-button">Confirmar pagamento</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <p>Não ha registros</p>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
