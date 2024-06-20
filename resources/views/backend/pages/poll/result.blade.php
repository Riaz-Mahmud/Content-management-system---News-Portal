@extends('backend/layouts/layoutMaster')

@section('title', 'Poll Result')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/backend/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/jszip/jszip.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/pdfmake/pdfmake.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-buttons/buttons.html5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-buttons/buttons.print.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/cleavejs/cleave.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('content')

    @if ($errors->any() || session('error'))
        @include('backend._partials.errorMsg')
    @endif

    @if (session('success'))
        @include('backend._partials.successMsg')
    @endif

    <div class="card">
        {{-- title --}}
        <div class="card-header">
            <h3 class="card-title">{{$data['poll']->question}}</h3>
        </div>
        <div class="row row-bordered g-0">
            @foreach ($data['poll_items'] as $item)
                <div class="col-md-4">
                    <div id="growthChart{{$item->id}}"></div>
                    <div class="text-center fw-semibold pt-3 mb-2">
                        {{$item->option}}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- table --}}
    </div>

    <div class="card mt-3">
        <div class="card-header border-bottom">
            <h5 class="card-title">Responses</h5>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>Option</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['rose'] as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>{{$item->pollItem->option}}</td>
                            <td>
                                @if ($item->user)
                                    {{$item->user->name}} <br>
                                    {{$item->user->email}}
                                @else
                                    {{$item->ip_address}}
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.poll.response.delete', Crypt::encrypt($item->id)) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger mb-1 mt-1" title="delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- div for paginate --}}
            <div class="d-flex justify-content-center mt-3 mb-3">
                {{ $data['rose']->links() }}
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    {{-- <script src="{{asset('assets/backend/js/dashboards-analytics.js')}}"></script> --}}
    <script>
        let cardColor, headingColor, legendColor, labelColor, shadeColor, borderColor;

        if (isDarkStyle) {
            cardColor = config.colors_dark.cardColor;
            headingColor = config.colors_dark.headingColor;
            legendColor = config.colors_dark.bodyColor;
            labelColor = config.colors_dark.textMuted;
            borderColor = config.colors_dark.borderColor;
        } else {
            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            legendColor = config.colors.bodyColor;
            labelColor = config.colors.textMuted;
            borderColor = config.colors.borderColor;
        }

        // loop with $data['poll_items']
        @foreach ($data['poll_items'] as $jsItem)
            const growthChart{{$jsItem->id}} = document.querySelector('#growthChart{{$jsItem->id}}');
                growthChartOptions = {
                series: [{{ $jsItem->percentage ?? 0 }}],
                labels: ['response'],
                chart: {
                    height: 240,
                    type: 'radialBar'
                },
                plotOptions: {
                    radialBar: {
                    size: 150,
                    offsetY: 10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: '55%'
                    },
                    track: {
                        background: cardColor,
                        strokeWidth: '100%'
                    },
                    dataLabels: {
                        name: {
                        offsetY: 15,
                        color: legendColor,
                        fontSize: '15px',
                        fontWeight: '600',
                        fontFamily: 'Public Sans'
                        },
                        value: {
                        offsetY: -25,
                        color: headingColor,
                        fontSize: '22px',
                        fontWeight: '500',
                        fontFamily: 'Public Sans'
                        }
                    }
                    }
                },
                colors: [config.colors.primary],
                fill: {
                    type: 'gradient',
                    gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 0.6,
                    stops: [30, 70, 100]
                    }
                },
                stroke: {
                    dashArray: 5
                },
                grid: {
                    padding: {
                    top: -35,
                    bottom: -10
                    }
                },
                states: {
                    hover: {
                    filter: {
                        type: 'none'
                    }
                    },
                    active: {
                    filter: {
                        type: 'none'
                    }
                    }
                }
            };
            if (typeof growthChart{{$jsItem->id}} !== undefined && growthChart{{$jsItem->id}} !== null) {
                const growthChart = new ApexCharts(growthChart{{$jsItem->id}}, growthChartOptions);
                growthChart.render();
            }
        @endforeach
    </script>
@endsection
