@extends('layouts.app')

@section('title', '管理画面')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<main class="admin-dashboard">
    <h1>お問い合わせ管理</h1>

    <form method="GET" action="{{ route('admin.dashboard') }}" class="search-form">
        <input type="text" name="name" placeholder="氏名" value="{{ request('name') }}">
        <input type="email" name="email" placeholder="メールアドレス" value="{{ request('email') }}">
        <select name="gender">
            <option value="all">性別</option>
            <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
        </select>
        <select name="category_id">
            <option value="">お問い合わせ種類</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>
        <input type="date" name="date" value="{{ request('date') }}">
        <button type="submit">検索</button>
        <a href="{{ route('admin.dashboard') }}" class="reset-btn">リセット</a>
        <a href="{{ route('admin.export') }}" class="export-btn">エクスポート</a>
    </form>

    <table class="contact-table">
        <thead>
            <tr>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>お問い合わせ種類</th>
                <th>内容</th>
                <th>日付</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->full_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->category->content ?? '-' }}</td>
                <td>{{ Str::limit($contact->detail, 20) }}</td>
                <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                <td>
                    <button class="detail-btn" data-id="{{ $contact->id }}">詳細</button>
                    <form method="POST" action="{{ route('admin.delete', $contact->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}

    <!-- モーダル -->
    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body">読み込み中...</div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/admin/contacts/${id}`)
                .then(res => res.json())
                .then(data => {
                    const modal = document.getElementById('modal');
                    const body = document.getElementById('modal-body');
                    body.innerHTML = `
                        <p><strong>氏名：</strong> ${data.full_name}</p>
                        <p><strong>メール：</strong> ${data.email}</p>
                        <p><strong>性別：</strong> ${data.gender_label}</p>
                        <p><strong>種別：</strong> ${data.category?.content ?? '-'}</p>
                        <p><strong>内容：</strong> ${data.detail}</p>
                    `;
                    modal.classList.remove('hidden');
                });
        });
    });

    document.querySelector('.close').addEventListener('click', () => {
        document.getElementById('modal').classList.add('hidden');
    });
});


document.querySelector('.close').addEventListener('click', () => {
    document.getElementById('modal').classList.add('hidden');
});
</script>
@endpush
