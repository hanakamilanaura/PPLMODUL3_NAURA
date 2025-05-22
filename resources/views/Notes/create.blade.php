@extends('layouts.app')
@section('content')
<div style="margin-top:20px;" class="poppins">
    <p> 
        <a href="/notes">Notes</a> / 
        <a href="/create-notes">Create Note</a>
    </p>
    <div class="container-form">
        <!-- Notifikasi -->
        @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #a7f3d0;">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div style="background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #fca5a5;">
            {{ session('error') }}
        </div>
        @endif

        <div class="form-note">
            <form method="POST" action="{{route('note-submit')}}">
                @csrf
                <div style="margin-bottom: 1.25rem;">
                    <input type="text" name="title" placeholder="Judul Catatan" required>
                </div>
                <div style="margin-bottom: 1.25rem;">
                    <textarea name="description" placeholder="Isi Catatan" required></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-submit-note">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection