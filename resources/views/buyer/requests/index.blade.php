@extends('layouts.buyer')
@section('title', 'Danh sách yêu cầu thu mua')
@section('content')
<h3>Danh sách yêu cầu bán / thanh lý</h3>

<form method="GET" class="mb-3 d-flex gap-2" style="max-width:300px">
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="">Tất cả trạng thái</option>
        @foreach (['pending','valuated','approved','rejected','completed'] as $s)
            <option value="{{ $s }}" @selected(request('status')==$s)>{{ $s }}</option>
        @endforeach
    </select>
</form>

<table class="table bg-white align-middle">
    <thead><tr><th>Ảnh</th><th>Người bán</th><th>Tiêu đề</th><th>Giá mong muốn</th><th>Giá đề xuất</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
        @forelse ($requests as $r)
            <tr>
                <td>
                    @if ($r->image)
                        <img src="{{ asset('storage/'.$r->image) }}" style="width:45px;height:45px;object-fit:cover" class="rounded">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width:45px;height:45px">🛋️</div>
                    @endif
                </td>
                <td>{{ $r->seller->name }}</td>
                <td>{{ $r->title }}</td>
                <td>{{ $r->expected_price ? number_format($r->expected_price).'₫' : '-' }}</td>
                <td>{{ $r->offered_price ? number_format($r->offered_price).'₫' : '-' }}</td>
                <td><span class="badge bg-secondary">{{ $r->status }}</span></td>
                <td><a href="{{ route('buyer.requests.show', $r) }}" class="btn btn-sm btn-outline-primary">Chi tiết</a></td>
            </tr>
        @empty
            <tr><td colspan="7">Không có yêu cầu nào.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $requests->links() }}
@endsection
