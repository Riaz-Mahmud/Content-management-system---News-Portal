@extends('frontend.layout.app')

@section('title', 'Peers Near Me')
@section('css')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endsection

@section('script')

    <script>
        function initMap() {

            const currentLocation = <?php print json_encode($data['center']); ?>;

            const uluru = { lat: parseFloat(currentLocation[1]), lng: parseFloat(currentLocation[2]) };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: uluru,
            });

            const locations = <?php print json_encode($data['markers']); ?>;
            setMarkers(map, locations);
        }

        window.initMap = initMap;

        function setMarkers(map, locations) {

            const image = {
                url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
                // This marker is 20 pixels wide by 32 pixels high.
                size: new google.maps.Size(20, 32),
                // The origin for this image is (0, 0).
                origin: new google.maps.Point(0, 0),
                // The anchor for this image is the base of the flagpole at (0, 32).
                anchor: new google.maps.Point(0, 32),
            };

            const shape = {
                coords: [1, 1, 1, 20, 18, 20, 18, 1],
                type: "poly",
            };

            for (let i = 0; i < locations.length; i++) {
                const location = locations[i];

                var beachMarker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(location[1]),
                        lng: parseFloat(location[2])
                    },
                    map,
                    icon: image,
                    shape: shape,
                    title: location[0],
                    zIndex: 99999999,
                    label: location[3],
                });

                const contentString = '<div id="content">' +
                    '<div id="siteNotice">' +
                    "</div>" +
                    '<h1 id="firstHeading" class="firstHeading">' + location[0] + '</h1>' +
                    '<div id="bodyContent">' +
                    '<p><b>Name: </b>' + location[3] + ' ' + location[4] + '<br>' +
                    '<b>Phone: </b>' + location[5] + '<br>' +
                    '<b>Email: </b>' + location[6] + '<br>' +
                    "</div>" +
                    "</div>";

                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                });

                beachMarker.addListener("click", () => {
                    infowindow.open(map, beachMarker);
                });
            }
        }

        $(document).ready(function() {

            $('#location').keypress(function(e) {
                if (e.which == 13) {
                    $('#search_peers').click();
                }
            });

            $('#search_peers').click(function() {
                var location = $('#location').val();
                if (location != '') {
                    $.ajax({
                        url: "{{ route('peers-nears-me.search') }}",
                        method: "POST",

                        data: {
                            _token: "{{ csrf_token() }}",
                            location: location
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                toastr.success(response.message);
                                const uluru = { lat: parseFloat(response.data.center[1]), lng: parseFloat(response.data.center[2]) };

                                map = new google.maps.Map(document.getElementById("map"), {
                                    zoom: 10,
                                    center: uluru,
                                });

                                const newlocations = response.data.markers;
                                setMarkers(map, newlocations);

                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                } else {
                    toastr.error('Please enter location');
                }
            });
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googleMaps.api_key') }}&map_ids=e24b393c59b842b4&callback=initMap" async defer>
    </script>

@endsection

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />

    <!--section   -->
    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="#">Home</a><span>Peers Nears Me</span>
            </div>
            <div class="scroll-down-wrap">
                <div class="mousey">
                    <div class="scroller"></div>
                </div>
                <span>Scroll Down To Discover</span>
            </div>
        </div>
        <div class="pwh_bg"></div>
    </div>

    <!--section   -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="main-container fl-wrap fix-container-init">
                        <div class="section-title">
                            <h2>Peers Near Me</h2>
                        </div>
                        <div class="box-widget fl-wrap " style="width: 95%;">
                            <div class="box-widget-content">
                                <div class="search-widget fl-wrap">
                                    <input name="location" id="location" type="text" class="search" placeholder="Search..." value="" />
                                    <button type="button" class="search-submit2" id="search_peers"><i class="far fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="map"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <!-- sidebar   -->
                    <div class="sidebar-content fl-wrap fixed-bar">

                        <!-- box-widget -->
                        <div class="box-widget fl-wrap">
                            <div class="widget-title">Categories</div>
                            <div class="box-widget-content">
                                <ul class="cat-wid-list">
                                    @foreach ($data['categories'] as $category)
                                        <li><a
                                                href="{{ URL::to($category->slug) }}">{{ $category->title }}</a><span>{{ $category->count ?? 0 }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- box-widget  end -->
                        <!-- box-widget -->
                        <x-frontend.social-icon.social-icon :position="'middle'" />
                        <!-- box-widget  end -->

                    </div>
                    <!-- sidebar  end -->
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />
@endsection
