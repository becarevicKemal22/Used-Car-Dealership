@extends('layouts.app')

@section('content')
    <div class="slideshow-container mb-4">

        <!-- Full-width images with number and caption text -->
        <div class="mySlides">
            <img src="https://wallpapercave.com/wp/wp2797466.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <img src="https://wallpapercave.com/wp/wp2797466.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <img src="https://wallpapercave.com/wp/wp2797466.jpg" style="width:100%">
        </div>
        <div style="text-align:center" class="dot-container">
            <span class="dot" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>
    </div>
    <br>
    <!-- The dots/circles -->

    <div class="row">
        <div class="carousel d-flex">
            <ul class="carousel-piece visible">
                <x-vehicle-card-small :vehicle="$vehicles[0]"></x-vehicle-card-small>
            </ul>
            <ul class="carousel-piece visible">
                <x-vehicle-card-small :vehicle="$vehicles[1]"></x-vehicle-card-small>
            </ul>
            <ul class="carousel-piece">
                <x-vehicle-card-small :vehicle="$vehicles[2]"></x-vehicle-card-small>
            </ul>
            <ul class="carousel-piece">
                <x-vehicle-card-small :vehicle="$vehicles[3]"></x-vehicle-card-small>
            </ul>
        </div>
    </div>

    <style>
        .slideshow-container {
            width: 100%;
            position: relative;
            margin: auto;
            overflow: hidden;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        .dot-container {
            position: absolute;
            top: 95%;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Fading animation */
        /* .fade {
                        animation-name: fade;
                        animation-duration: 1.5s;
                    } */

        @keyframes fade {
            from {
                opacity: .75
            }

            to {
                opacity: 1
            }
        }
    </style>

    <script>
        let slideIndex = 0;
        showSlides(slideIndex++);
        let myInterval = setInterval(() => {
            showSlides(slideIndex++);
        }, 5000);

        function currentSlide(n) {
            clearInterval(myInterval);
            showSlides(n++);
            slideIndex = n;
            myInterval = setInterval(() => {
            showSlides(slideIndex++);
        }, 5000);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            console.log(n);
            if (n >= slides.length) {
                n = 0;
                slideIndex = 1;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[n].style.display = "block";
            dots[n].className += " active";
        }
    </script>
@endsection
