@extends('layouts.admin')

@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Infomações do cupom</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.index') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{ route('admin.coupons') }}">
                        <div class="text-tiny">Coupons</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Novo Cupom</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.coupon.store') }}">
                @csrf
                <fieldset class="name">
                    <div class="body-title">Código do cupom <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Código do cupom" name="code" tabindex="0" value="{{ old('code') }}" aria-required="true" required="">
                </fieldset>
                @error('code') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                <fieldset class="category">
                    <div class="body-title">Tipo de Cupom</div>
                    <div class="select flex-grow">
                        <select class="" name="type">
                            <option value="">Selecione...</option>
                            <option value="fixed">Fixo</option>
                            <option value="percent">Percentual</option>
                        </select>
                    </div>
                </fieldset>
                @error('type') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                <fieldset class="name">
                    <div class="body-title">Valor <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Valor do cupom" name="value" tabindex="0" value="{{ old('value') }}" aria-required="true" required="">
                </fieldset>
                @error('value') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                <fieldset class="name">
                    <div class="body-title">Valor do carrinho <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Valor do carrinho" name="cart_value" tabindex="0" value="{{ old('cart_value') }}" aria-required="true" required="">
                </fieldset>
                @error('cart_value') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                <fieldset class="name">
                    <div class="body-title">Validade cupom <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="date" placeholder="Validade cupom" name="expiry_date" tabindex="0" value="{{ old('expiry_date') }}" aria-required="true" required="">
                </fieldset>
                @error('expiry_date') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

{{-- @push('scripts')
    <script>
        $(function(){
            $("#myFile").on("change", function(e){
                const photoInp = $("myFile");
                const[file] = this.files;
                if(file)
                {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

            $("#gFile").on("change", function(e){
                const photoInp = $("#gFile");
                const gphotos = this.files;
                $.each(gphotos, function(key, val) {
                    $("#galUpload").prepend(`<div class="item gitems"><img src="${URL.createObjectURL(val)}" /></div>`);
                });
            });

            $("input[name='name']").on("change", function(){
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });
        });

        function StringToSlug(Text)
        {
            return Text.toLowerCase()
            .replace(/[^\w ]+/g, "")
            .replace(/ +/g,"-");
        }
    </script>
@endpush --}}
