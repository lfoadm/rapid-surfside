@extends('layouts.admin')
@section('content')
    
<div class="main-content-wrap">
    <div class="tf-section-2 mb-30">
        <div class="flex gap20 flex-wrap-mobile">
            <div class="w-half">

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Total de pedidos</div>
                                <h4>{{ $dashboardDatas[0]->Total }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Valor total</div>
                                <h4>{{ number_format($dashboardDatas[0]->TotalAmount, 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Pedidos pendentes</div>
                                <h4>{{ $dashboardDatas[0]->TotalOrdered }}</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Valor dos pedidos pendentes</div>
                                <h4>{{ number_format($dashboardDatas[0]->TotalOrderedAmount, 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-half">

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Pedidos entregues</div>
                                <h4>{{ $dashboardDatas[0]->TotalDelivered }}</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Valor dos pedidos entregues</div>
                                <h4>{{ number_format($dashboardDatas[0]->TotalDeliveredAmount, 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Pedidos cancelados</div>
                                <h4>{{ $dashboardDatas[0]->TotalCanceled }}</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Valor dos pedidos cancelados</div>
                                <h4>{{ number_format($dashboardDatas[0]->TotalCanceledAmount, 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Receita mensal</h5>
            </div>
            <div class="flex flex-wrap gap40">
                <div>
                    <div class="mb-2">
                        <div class="block-legend">
                            <div class="dot t1"></div>
                            <div class="text-tiny">Total</div>
                        </div>
                    </div>
                    <div class="flex items-center gap10">
                        <h4>R$ {{ $TotalAmount }}</h4>
                    </div>
                </div>
                <div>
                    <div class="mb-2">
                        <div class="block-legend">
                            <div class="dot t2"></div>
                            <div class="text-tiny">Pendentes</div>
                        </div>
                    </div>
                    <div class="flex items-center gap10">
                        <h4>R$ {{ $TotalOrderedAmount }}</h4>
                    </div>
                </div>
                <div>
                    <div class="mb-2">
                        <div class="block-legend">
                            <div class="dot t2"></div>
                            <div class="text-tiny">Entregues</div>
                        </div>
                    </div>
                    <div class="flex items-center gap10">
                        <h4>R$ {{ $TotalDeliveredAmount }}</h4>
                    </div>
                </div>
                <div>
                    <div class="mb-2">
                        <div class="block-legend">
                            <div class="dot t2"></div>
                            <div class="text-tiny">Cancelados</div>
                        </div>
                    </div>
                    <div class="flex items-center gap10">
                        <h4>R$ {{ $TotalCanceledAmount }}</h4>
                    </div>
                </div>
            </div>
            <div id="line-chart-8"></div>
        </div>

    </div>
    <div class="tf-section mb-30">

        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Recent orders</h5>
                <div class="dropdown default">
                    <a class="btn btn-secondary dropdown-toggle" href="{{ route('admin.orders') }}">
                        <span class="view-all">Ver todos</span>
                    </a>
                </div>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:70px">Nº pedido</th>
                                <th class="text-center">Nome</th>
                                <th class="text-center">Celular</th>
                                <th class="text-center">Sub total</th>
                                <th class="text-center">Tarifa</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Data pedido</th>
                                <th class="text-center">Total itens</th>
                                <th class="text-center">Entregue em</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td class="text-center">{{ $order->name }}</td>
                                <td class="text-center">{{ $order->phone }}</td>
                                <td class="text-center">R$ {{ number_format(floatval($order->subtotal),2,',','.') }}</td>
                                <td class="text-center">R$ {{ number_format(floatval($order->tax),2,',','.') }}</td>
                                <td class="text-center">R$ {{ number_format(floatval($order->total),2,',','.') }}</td>
                                <td class="text-center">
                                    @if($order->status == 'delivered')
                                        <span class="badge bg-success">Entregue</span>
                                    @elseif($order->status == 'canceled')
                                        <span class="badge bg-danger">Cancelado</span>
                                    @else
                                        <span class="badge bg-warning">Pedido</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">{{ $order->orderItems->count() }}</td>
                                <td class="text-center">{{ $order->delivered_date ? \Carbon\Carbon::parse($order->delivered_date)->format('d/m/Y H:i') : '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.order.show', ['order_id' => $order->id]) }}">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    (function ($) {

        var tfLineChart = (function () {

            var chartBar = function () {

                var options = {
                    series: [{
                        name: 'Total',
                        data: [{{ $AmountM }}]
                    }, {
                        name: 'Pendentes',
                        data: [{{ $OrderedAmountM }}]
                    },
                    {
                        name: 'Entregues',
                        data: [{{ $DeliveredAmountM }}]
                    }, {
                        name: 'Cancelados',
                        data: [{{ $CanceledAmountM }}]
                    }],
                    chart: {
                        type: 'bar',
                        height: 325,
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '10px',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false,
                    },
                    colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                    stroke: {
                        show: false,
                    },
                    xaxis: {
                        labels: {
                            style: {
                                colors: '#212529',
                            },
                        },
                        categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    },
                    yaxis: {
                        show: false,
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "$ " + val + ""
                            }
                        }
                    }
                };

                chart = new ApexCharts(
                    document.querySelector("#line-chart-8"),
                    options
                );
                if ($("#line-chart-8").length > 0) {
                    chart.render();
                }
            };

            /* Function ============ */
            return {
                init: function () { },

                load: function () {
                    chartBar();
                },
                resize: function () { },
            };
        })();

        jQuery(document).ready(function () { });

        jQuery(window).on("load", function () {
            tfLineChart.load();
        });

        jQuery(window).on("resize", function () { });
    })(jQuery);
</script>
@endpush