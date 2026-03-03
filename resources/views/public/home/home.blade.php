{{--
    Halaman Beranda Publik — Serindit
    Layout : public.layout.app
    Sections:
      - public.home.hero    (hero section + ilustrasi)
      - public.home.content (koleksi, jenjang, populer, kategori, CTA)
--}}
@extends('public.layout.app')

@section('title', 'Serindit — Perpustakaan Digital Balai Bahasa Provinsi Riau')
@section('description', 'Serindit adalah platform membaca buku digital gratis dari Balai Bahasa Provinsi Riau. Ribuan buku tersedia untuk semua kalangan!')

@section('content')
    @include('public.home.statsbar')
    @include('public.home.hero')
    @include('public.home.content')
@endsection
