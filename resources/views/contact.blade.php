@extends('layouts.app')
@section('content')
<style>
    .text-danger{
        color:red !important;
    }
</style>
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <h2 class="page-title">Fale conosco</h2>
      </div>
    </section>

    <hr class="mt-2 text-secondary " />
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <div class="contact-us__form">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{Session::get('success')}}</div>
            @endif
          <form action="{{ route('home.contact.store') }}" name="contact-us-form" class="needs-validation" novalidate="" method="POST">
            @csrf
            <h3 class="mb-5">Entre em contato</h3>
            <div class="form-floating my-4">
              <input type="text" class="form-control" name="name" placeholder="Name *" value="{{ old('name') }}" required="">
              <label for="contact_us_name">Nome *</label>
              @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-floating my-4">
              <input type="text" class="form-control" name="phone" placeholder="Phone *" value="{{ old('phone') }}" required="">
              <label for="contact_us_name">Celular *</label>
              @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-floating my-4">
              <input type="email" class="form-control" name="email" placeholder="Email address *" value="{{ old('email') }}" required="">
              <label for="contact_us_name">E-mail *</label>
              @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="my-4">
              <textarea class="form-control form-control_gray" name="comment" placeholder="Sua mensagem" cols="30" rows="8" value="{{ old('comment') }}" required=""></textarea>
              @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="my-4">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
@endsection