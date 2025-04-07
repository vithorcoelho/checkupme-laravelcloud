<div>
    <div>
        <div class="space-y-2 w-full">
            <!-- Carousel Principal -->
            <div id="main-slider" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach(json_decode($user->userProfessional->gallery) as $image)
                            <li class="splide__slide">
                                <img src="{{ $image->url }}" class="w-full h-auto rounded-lg">
                            </li>
                        @endforeach
                    </ul>

                    <!-- Arrows dentro do slider -->
                    <div class="splide__arrows absolute inset-0 flex justify-between items-center px-2">
                        <button class="splide__arrow splide__arrow--prev bg-transparent">
                            <flux:icon icon="chevron-right" class="w-6 h-6 text-white"/>
                        </button>

                        <button class="splide__arrow splide__arrow--next">
                            <flux:icon icon="chevron-right" class="w-6 h-6 text-white"/>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Miniaturas -->
            <div id="thumbnail-slider" class="splide thumbnail-slider rounded-lg">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach(json_decode($user->userProfessional->gallery) as $image)
                            <li class="splide__slide">
                                <img src="{{ $image->url }}">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Script para Iniciar o SplideJS -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var main = new Splide('.splide', {
                    type: 'fade',
                    heightRatio: 0.5,
                    pagination: false,
                    arrows: true, // Deixe ativado
                    cover: true,

                });

                var thumbnails = new Splide('#thumbnail-slider', {
                    arrows: false,
                    focus: 'center',
                    pagination: false,
                    isNavigation: true,
                    rewind: true,
                    gap: 8,
                    dragMinThreshold: {
                        mouse: 3,
                        touch: 10,
                    }, 
                    /* breakpoints: {
                        640: {
                            fixedWidth: 66,
                            fixedHeight: 38,
                        },
                    }, */
                });

                main.sync(thumbnails);
                main.mount();
                thumbnails.mount();
            });
        </script>

        <style>
            .splide {
                padding: 0 !important;
            }

            .splide__track {
                border-radius: 6px !important;
            }

            .splide__arrow svg{
                fill: none !important;
            }

            .splide__arrow {
                width: 40px;
                height: 40px;
                opacity: 0.8;
                transition: opacity 0.3s;
            }

            .splide__arrow:hover {
                opacity: 1;
            }

            .thumbnail-slider .splide__slide {
                max-width: 160px !important;
                max-height: 80px !important;
                object-fit: cover;
                cursor: pointer;
                border: none !important;
                border-radius: 6px !important;
                overflow: overlay;
                padding: 0 !important;
            }

            .splide__track--nav>.splide__list>.splide__slide.is-active {
                border: none;
            }

            .splide__slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        </style>
    </div>
</div>