@include('layouts.frontheader')

<section class="innter_hero">
    <div class="container">
        <div class="innter_hero_top">
            <h2 class="title_72">{{ $project->name }}</h2>
            <ul class="innter_hero_link">
                <li><a href="{{ url('/') }}">Our Portfolio </a> <b class="fw-normal">/</b></li>
                <li>{{ $project->industry?->title ?? 'No Industry' }} <b class="fw-normal">/</b></li>
                <li><span>{{ $project->name }}</span></li>
            </ul>
        </div>

        <div class="innter_hero_bot">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <p class="title_30 mb-0">{!! $project->detail_description !!}
                    </p>
                </div>
                <div class="col-md-5">
                    <div class="innter_hero_bot_rt">
                        @if($sector !== null && count($sector) > 0)
                            <div class="child">
                                <h6>Sector:</h6>
                                @foreach($sector as $sec)
                                    <p class="para">{{ $sec }}</p>
                                @endforeach
                            </div>
                        @endif

                        @if(!empty($project->website_url))
                            <div class="child">
                                <h6>Website:</h6>
                                <p class="para">{!! $project->website_url !!}</p>
                            </div>
                        @endif

                        {{-- @if(!empty($project->linkedin_link) || !empty($project->instagram_link) || !empty($project->phone) || !empty($project->facebook_link))
                            <div class="child">
                                <h6>See Our Work:</h6>
                                <p class="icon">
                                    @if(!empty($project->linkedin_link))
                                        <a href="{{ $project->linkedin_link }}" target="_blank">
                                            <!-- LinkedIn Icon SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M22.2234 0H1.77187C0.792187 0 0 0.773438 0 1.72969V22.2656C0 23.2219 0.792187 24 1.77187 24H22.2234C23.2031 24 24 23.2219 24 22.2703V1.72969C24 0.773438 23.2031 0 22.2234 0ZM7.12031 20.4516H3.55781V8.99531H7.12031V20.4516ZM5.33906 7.43437C4.19531 7.43437 3.27187 6.51094 3.27187 5.37187C3.27187 4.23281 4.19531 3.30937 5.33906 3.30937C6.47812 3.30937 7.40156 4.23281 7.40156 5.37187C7.40156 6.50625 6.47812 7.43437 5.33906 7.43437ZM20.4516 20.4516H16.8937V14.8828C16.8937 13.5562 16.8703 11.8453 15.0422 11.8453C13.1906 11.8453 12.9094 13.2937 12.9094 14.7891V20.4516H9.35625V8.99531H12.7687V10.5609H12.8156C13.2891 9.66094 14.4516 8.70937 16.1813 8.70937C19.7859 8.70937 20.4516 11.0812 20.4516 14.1656V20.4516V20.4516Z" fill="#666666" />
                                            </svg>
                                        </a>
                                    @endif
                        
                                    @if(!empty($project->instagram_link))
                                        <a href="{{ $project->instagram_link }}" target="_blank">
                                            <!-- Instagram Icon SVG -->
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.9705 11.9999C15.9705 14.1927 14.1927 15.9705 11.9999 15.9705C9.8071 15.9705 8.0293 14.1927 8.0293 11.9999C8.0293 9.8071 9.8071 8.0293 11.9999 8.0293C14.1927 8.0293 15.9705 9.8071 15.9705 11.9999Z" fill="black" />
                                                <path d="M18.7059 0H5.29412C2.37477 0 0 2.37477 0 5.29412V18.7059C0 21.6252 2.37477 24 5.29412 24H18.7059C21.6252 24 24 21.6252 24 18.7059V5.29412C24 2.37477 21.6252 0 18.7059 0ZM12 18.6176C8.35099 18.6176 5.38235 15.649 5.38235 12C5.38235 8.35099 8.35099 5.38235 12 5.38235C15.649 5.38235 18.6176 8.35099 18.6176 12C18.6176 15.649 15.649 18.6176 12 18.6176ZM19.5882 5.73529C18.8572 5.73529 18.2647 5.14281 18.2647 4.41176C18.2647 3.68072 18.8572 3.08824 19.5882 3.08824C20.3193 3.08824 20.9118 3.68072 20.9118 4.41176C20.9118 5.14281 20.3193 5.73529 19.5882 5.73529Z" fill="black" />
                                            </svg>
                                        </a>
                                    @endif
                        
                                    @if(!empty($project->phone))
                                        <a href="tel:{{ $project->phone }}">
                                            <!-- Phone Icon SVG -->
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_1166)">
                                                    <path d="M12.003 0H11.997C5.3805 0 0 5.382 0 12C0 14.625 0.846 17.058 2.2845 19.0335L0.789 23.4915L5.4015 22.017C7.299 23.274 9.5625 24 12.003 24C18.6195 24 24 18.6165 24 12C24 5.3835 18.6195 0 12.003 0ZM18.9855 16.9455C18.696 17.763 17.547 18.441 16.6305 18.639C16.0035 18.7725 15.1845 18.879 12.4275 17.736C8.901 16.275 6.63 12.6915 6.453 12.459C6.2835 12.2265 5.028 10.5615 5.028 8.8395C5.028 7.1175 5.9025 6.279 6.255 5.919C6.5445 5.6235 7.023 5.4885 7.482 5.4885C7.6305 5.4885 7.764 5.496 7.884 5.502C8.2365 5.517 8.4135 5.538 8.646 6.0945C8.9355 6.792 9.6405 8.514 9.7245 8.691C9.81 8.868 9.8955 9.108 9.7755 9.3405C9.663 9.5805 9.564 9.687 9.387 9.891C9.21 10.095 9.042 10.251 8.865 10.47C8.703 10.6605 8.52 10.8645 8.724 11.217C8.928 11.562 9.633 12.7125 10.671 13.6365C12.0105 14.829 13.0965 15.21 13.485 15.372C13.7745 15.492 14.1195 15.4635 14.331 15.2385C14.5995 14.949 14.931 14.469 15.2685 13.9965C15.5085 13.6575 15.8115 13.6155 16.1295 13.7355C16.4535 13.848 18.168 14.6955 18.5205 14.871C18.873 15.048 19.1055 15.132 19.191 15.2805C19.275 15.429 19.275 16.1265 18.9855 16.9455Z" fill="#666666" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1_1166">
                                                        <rect width="24" height="24" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    @endif
                        
                                    @if(!empty($project->facebook_link))
                                        <a href="{{ $project->facebook_link }}" target="_blank">
                                            <!-- Facebook Icon SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <g clip-path="url(#clip0_1_1170)">
                                                    <path d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 17.9895 4.3882 22.954 10.125 23.8542V15.4687H7.07812V12H10.125V9.35625C10.125 6.34875 11.9166 4.6875 14.6576 4.6875C15.9701 4.6875 17.3437 4.92187 17.3437 4.92187V7.875H15.8306C14.34 7.875 13.875 8.80008 13.875 9.75V12H17.2031L16.6711 15.4687H13.875V23.8542C19.6118 22.954 24 17.9895 24 12Z" fill="#666666" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1_1170">
                                                        <rect width="24" height="24" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    @endif
                                </p>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="project_details">
    <div class="container">
        <div class="row g-4">
            @foreach($project->product_images as $image)
                @if($loop->iteration == 1 || $loop->iteration == 4 || $loop->iteration == 7) <!-- 1st and 4th image -->
                    <div class="col-md-12 home_card">
                        <div class="home_card_img">
                            <img class="w-100" src="{{ asset('public/product_multiple_images/' . $image) }}" alt="image">
                        </div>
                    </div>
                @else <!-- For other images -->
                    <div class="col-md-6 home_card">
                        <div class="home_card_img">
                            <img class="w-100" src="{{ asset('public/product_multiple_images/' . $image) }}" alt="image">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>



<div class="container">
    <div class="project_details_link">
        
        @if($nextProject)
            <a href="{{ url('projects/' . $nextProject->url) }}">
                <span>Next Project </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="15" viewBox="0 0 70 15" fill="none">
                        <path
                            d="M69.7071 8.07088C70.0976 7.68035 70.0976 7.04719 69.7071 6.65666L63.3431 0.292702C62.9526 -0.0978227 62.3195 -0.0978227 61.9289 0.292702C61.5384 0.683226 61.5384 1.31639 61.9289 1.70692L67.5858 7.36377L61.9289 13.0206C61.5384 13.4111 61.5384 14.0443 61.9289 14.4348C62.3195 14.8254 62.9526 14.8254 63.3431 14.4348L69.7071 8.07088ZM0 7.36377V8.36377H69V7.36377V6.36377H0V7.36377Z"
                            fill="#282663" />
                    </svg>
                </span>
            </a>
        @else
            <span>No next project available</span>
        @endif
    </div>
</div>


@include('layouts.frontfooter')

