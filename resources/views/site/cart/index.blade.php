@extends('layouts.app')
@section('content')
<style>
    .text-success{
        color: #278c04 !important;
    }
    .text-danger{
        color: red !important;
    }
</style>
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Carrinho</h2>
        <div class="checkout-steps">
            <a href="javascript:void(0)" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Carrinho de compras</span>
                    <em>Gerencie sua lista de itens</em>
                </span>
            </a>
            <a href="javascript:void(0)" class="checkout-steps__item">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Envio e finalizar compra</span>
                    <em>Confira sua lista de itens</em>
                </span>
            </a>
            <a href="javascript:void(0)" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Confirmação</span>
                    <em>Revise e envie seu pedido</em>
                </span>
            </a>
        </div>
        <div class="shopping-cart">
            @if ($items->count()>0)
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th></th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            <img loading="lazy" src="{{ asset('uploads/products/thumbnails') }}/{{ $item->model->image }}" width="120" height="120" alt="{{ $item->name }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>{{ $item->name }}</h4>
                                            <ul class="shopping-cart__product-item__options">
                                                <li>Cor: Amarelo</li>
                                                <li>Tamanho: M</li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__product-price">R${{ $item->price }}</span>
                                    </td>
                                    <td>
                                        <div class="qty-control position-relative">
                                            <input type="number" name="quantity" value="{{ $item->qty }}" min="1" class="qty-control__number text-center">
                                            
                                            <form method="POST" action="{{ route('cart.qty.decrease', ['rowId' => $item->rowId]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="qty-control__reduce">-</div>
                                            </form>
                                            
                                            <form method="POST" action="{{ route('cart.qty.increase', ['rowId' => $item->rowId]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="qty-control__increase">+</div>
                                            </form>

                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__subtotal">R${{ $item->subTotal() }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.item.remove', ['rowId' => $item->rowId]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" class="remove-cart">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                    <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                </svg>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="cart-table-footer">
                        @if(!Session::has('coupon'))
                            <form action="{{ route('cart.coupon.apply') }}" method="POST" class="position-relative bg-body">
                                @csrf
                                <input class="form-control" type="text" name="coupon_code" placeholder="Código do cupom" value="">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="APLICAR CUPOM">
                            </form>
                        @else
                            <form action="{{ route('cart.coupon.remove') }}" method="POST" class="position-relative bg-body">
                                @csrf
                                @method('DELETE')
                                <input class="form-control" type="text" name="coupon_code" placeholder="Código do cupom" value="@if(Session::has('coupon')) {{ Session::get('coupon')['code'] }} Validado! @endif">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="REMOVER CUPOM">
                            </form>
                        @endif

                        <form action="{{ route('cart.empty') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-light">Limpar carrinho</button>
                        </form>
                    </div>
                    <div>
                        @if(Session::has('success'))
                            <p class="text-success">{{ Session::get('success') }}</p>
                        @elseif(Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                    </div>
                </div>
                <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>Valor total do carrinho</h3>
                            @if (Session::has('discounts'))

                            <table class="cart-totals">
                                <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>R${{ Cart::instance('cart')->subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Desconto {{ Session::get('coupon')['code'] }}</th>
                                        <td>R${{ Session::get('discounts')['discount'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtotal com desconto</th>
                                        <td>R${{ Session::get('discounts')['subtotal'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Frete</th>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <th>Impostos</th>
                                        <td>R${{ Session::get('discounts')['tax'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>R${{ Session::get('discounts')['total'] }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            @else
                            
                            <table class="cart-totals">
                                <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>R${{ Cart::instance('cart')->subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Frete</th>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <th>Impostos</th>
                                        <td>R${{ Cart::instance('cart')->tax() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>R${{ Cart::instance('cart')->total() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-checkout">Continuar a compra</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12 text-center pt-5 bp-5">
                        <p>Nenhum item encontrado em seu carrinho</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-info">Comprar agora</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    $(function() {
        $(".qty-control__increase").on("click", function(){
            $(this).closest('form').submit();
        });

        $(".qty-control__reduce").on("click", function(){
            $(this).closest('form').submit();
        });

        $(".remove-cart").on("click", function(){
            $(this).closest('form').submit();
        });

    });
</script>
@endpush