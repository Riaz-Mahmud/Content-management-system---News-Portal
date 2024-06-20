<div class="card mb-4">
    <div class="user-profile-header-banner">
        <img src="{{ asset('assets/backend/img/pages/profile-banner.png') }}" alt="Banner image"
            class="rounded-top">
    </div>
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
            <img src="{{ $data['profile']->image }}" alt="user image"
                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
            <div
                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                <div class="user-profile-info">
                    <h4>{{ $data['profile']->last_name ? $data['profile']->last_name . ', ' . $data['profile']->first_name : $data['profile']->first_name }}</h4>
                    <ul
                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                        <li class="list-inline-item fw-semibold">
                            <i class='bx bx-pen'></i> {{ $data['profile']->profession }}
                        </li>
                        <li class="list-inline-item fw-semibold">
                            <i class='bx bx-map'></i> {{ $data['profile']->mailing_address }}
                        </li>
                        <li class="list-inline-item fw-semibold">
                            <i class='bx bx-calendar-alt'></i> Joined
                            {{ Carbon\Carbon::parse($data['profile']->created_at)->format('F Y') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
