@extends('layouts.app')

@section('title', '管理画面')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<header class="site-header">
    <h1 class="header-logo">FashionablyLate</h1>
    <nav class="header-nav">
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="submit" class="header-nav__link">logout</button>
        </form>
    </nav>
</header>

<main class="admin-dashboard">
    <h1>Admin</h1>

    <form method="GET" action="{{ route('admin.dashboard') }}" class="search-form">
        <input type="text" name="keyword" placeholder="氏名またはメールアドレス" value="{{ request('keyword') }}">
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

    <div class="table-header">
        <div class="pagination-wrapper">
            {{ $contacts->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <table class="contact-table">
        <thead>
            <tr>
                <th>氏名</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->full_name }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content ?? '-' }}</td>
                <td>
                    <button class="detail-btn" data-id="{{ $contact->id }}">詳細</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- モーダル -->
     <div id="modal" class="modal hidden">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body">読み込み中...</div>
            <form id="modal-delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const modalBody = document.getElementById('modal-body');
    const closeBtn = modal.querySelector('.close');
    const deleteForm = document.getElementById('modal-delete-form');

    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            modalBody.innerHTML = '読み込み中...';
            modal.classList.remove('hidden');

            fetch(`/admin/contacts/${id}`)
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    modalBody.innerHTML = `
                        <p><strong>氏名：</strong> ${data.full_name}</p>
                        <p><strong>メール：</strong> ${data.email}</p>
                        <p><strong>性別：</strong> ${data.gender_label}</p>
                        <p><strong>種別：</strong> ${data.category?.content ?? '-'}</p>
                        <p><strong>内容：</strong> ${data.detail}</p>
                    `;
                    deleteForm.action = `/admin/contacts/${id}`;
                })
                .catch(err => {
                    console.error(err);
                    modalBody.innerHTML = '<p>データの取得に失敗しました</p>';
                });
        });
    });;

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    }

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
</script>
@endpush

