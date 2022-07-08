@extends('layouts.frontend')

@section('content')

 <!-- START: BREADCRUMB -->
 <section class="bg-gray-100 py-8 px-4">
    <div class="container mx-auto">
      <ul class="breadcrumb">
        <li>
          <a href="{{ route('index') }}">Home</a>
        </li>
        <li>
          <a href="#" aria-label="current-page">Success Checkout</a>
        </li>
      </ul>
    </div>
  </section>
  <!-- END: BREADCRUMB -->

  <!-- START: CONGRATS -->
  <section class="">
    <div class="container mx-auto min-h-screen">
      <div class="flex flex-col items-center justify-center">
        <div class="w-full md:w-4/12 text-center">
          <img
            src="/frontend/images/content/illustration-success1.png"
            alt="congrats illustration"
          />
          <h2 class="text-3xl font-semibold mb-6">Proses Pembayaran Telah Berhasil</h2>
          <p class="text-lg mb-12">
            Smartphone yang anda beli akan kami kirimkan saat ini juga.
          </p>
          <a href="{{ route('index') }}"
            class="text-gray-900 bg-red-200 focus:outline-none w-full py-3 rounded-full text-lg focus:text-black transition-all duration-200 px-8 cursor-pointer"
          >
            Belanja Lagi Yukkk
        </a>
        </div>
      </div>
    </div>
  </section>
  <!-- END: CONGRATS -->
    
@endsection
