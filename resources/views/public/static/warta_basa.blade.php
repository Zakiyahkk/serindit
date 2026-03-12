@extends('public.layout.app')

@section('title', 'Warta Basa - Serindit')

@section('content')
<div class="max-w-6xl mx-auto px-6 lg:px-10 py-16">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold font-serif text-brand-navy mb-4">Warta Basa</h1>
        <p class="text-gray-500">Berita dan artikel menarik seputar bahasa dan sastra.</p>
    </div>
    
    <div class="bg-[#F8FAFF] p-10 rounded-2xl text-center border border-gray-100">
        <i class="bi bi-journal-text text-5xl text-brand-green mb-4 inline-block"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Halaman Sedang Dalam Pengembangan</h3>
        <p class="text-gray-500">Kami sedang menyiapkan Warta Basa terbaik untuk Anda baca di sini.</p>
        <a href="{{ route('home') }}" class="mt-6 inline-block bg-brand-green text-white px-6 py-2.5 rounded-full font-medium hover:bg-green-700 transition">Kembali ke Beranda</a>
    </div>
</div>
@endsection
