@extends('layouts.seller')
@section('title', 'Yêu cầu bán của tôi')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Yêu cầu bán / thanh lý của tôi</h3>
    <a href="{{ route('seller.requests.create') }}" class="btn btn-primary">+ Gửi yêu cầu mới</a>
</div>

<table class="table bg-white align-middle">
    <thead><tr><th>Ảnh</th><th>Tiêu đề</th><th>Danh mục</th><th>Giá mong muốn</th><th>Giá thu mua</th><th>Trạng thái</th><th></th></tr></thead>
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
                <td>{{ $r->title }}</td>
                <td>{{ $r->category->name ?? '-' }}</td>
                <td>{{ $r->expected_price ? number_format($r->expected_price).'₫' : '-' }}</td>
                <td>{{ $r->offered_price ? number_format($r->offered_price).'₫' : '-' }}</td>
                <td>
                    @php
                        $badge = ['pending'=>'secondary','valuated'=>'warning','approved'=>'primary','rejected'=>'danger','completed'=>'success'][$r->status] ?? 'secondary';
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ $r->status }}</span>
                </td>
                <td><a href="{{ route('seller.requests.show', $r) }}" class="btn btn-sm btn-outline-primary">Chi tiết</a></td>
            </tr>
        @empty
            <tr><td colspan="7">Chưa có yêu cầu nào.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $requests->links() }}
@endsection
