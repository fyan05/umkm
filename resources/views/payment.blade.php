@extends('template')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 700px;">
        <h4 class="fw-bold text-center mb-4">Invoice Details</h4>

        <div class="mb-4">
            <p><strong>Invoice Number:</strong> {{ $invoice->no_invoice }}</p>
            <p><strong>Date:</strong> {{ date('d-m-Y', strtotime($invoice->created_at)) }}</p>
            <p><strong>Expired:</strong> {{ date('d-m-Y', strtotime($invoice->expired_at)) }}</p>
        </div>

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>Items</th>
                    <th>Qty</th>
                    <th>Price (Rp)</th>
                    <th>Discount (%)</th>
                    <th>Subtotal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($invoice->invoice_detail as $item)
                    @php
                        $subtotal = $item->qty * $item->price;
                        $total += $subtotal;
                        $discount = $item->promo->diskon ?? 0;
                    @endphp
                    <tr>
                        <td>{{ $item->produk->name ?? 'Produk Tidak Ditemukan' }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $discount }}%</td>
                        <td>{{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between fw-bold mt-3">
            <span>Total Amount:</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="mt-4">
            <p><strong>Upload Payment Proof:</strong></p>
            <form action="/payment/{{ Crypt::encrypt($invoice->no_invoice) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="proof" class="form-control mb-3">
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50 me-2">Confirm Payment</button>
                    <a href="/cart" class="btn btn-secondary w-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
