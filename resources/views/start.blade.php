<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Offline') }}</title>

    <!-- Scripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.0.0/p5.min.js"
            integrity="sha256-Pg1di+fBF53Rbh9oZR/FeD1xsFzTLC963lcac1D0ias="
            crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="#" />

    <link rel="icon" href="/img/favicon.ico" type="image/x-icon"/>

    <!-- Styles -->

    <link href="/css/app.css" rel="stylesheet">

    <style>

        body {
            margin: 0;
            overflow: hidden;
        }

        #logo {
            position: fixed;
            width: 40%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

</head>
    <body class="bg-gray-700 ">

    @guest()
        <a href="/login">
            <svg id="logo" class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080">
                <style>.st0 {
                        fill: #231f20
                    }</style>
                <g id="Layer_2">
                    <path class="st0" d="M862.9 159.5h30v761.7h-30zM980.5 159.5h30v761.7h-30z"/>
                    <path transform="rotate(-90 1249.168 367.704)" class="st0" d="M1234.2-57.8h30v851h-30z"/>
                    <path transform="rotate(-90 910.694 174.527)" class="st0" d="M895.7 153.1h30V196h-30z"/>
                    <path transform="rotate(-90 1029.09 174.527)" class="st0" d="M1014.1 153.9h30v41.2h-30z"/>
                    <path class="st0"
                          d="M1098.4 393.5h30v319.3h-30zM1518.3 393.5h30v319.3h-30zM1308.4 393.5h30v319.3h-30zM1203.4 393.5h30v319.3h-30zM1442.5 492.5h30v220.3h-30z"/>
                    <path transform="rotate(-90 1605.675 697.78)" class="st0" d="M1590.7 628.8h30v138h-30z"/>
                    <path transform="rotate(-90 1592.469 408.49)" class="st0" d="M1577.5 358.3h30v100.3h-30z"/>
                    <path transform="rotate(-90 1566.031 492.517)" class="st0" d="M1551 468.8h30v47.4h-30z"/>
                    <path transform="rotate(-90 1354.484 423.494)" class="st0" d="M1339.5 397.9h30v51.3h-30z"/>
                    <path class="st0" d="M1338.4 408.5h49.9c46.5 0 84.2 24 84.2 53.6v91.1"/>
                    <path transform="rotate(-90 1145.187 697.78)" class="st0" d="M1130.2 680.9h30v33.8h-30z"/>
                    <path class="st0"
                          d="M625.5 282.8l-14.7 26.1c80.4 45.8 134.6 132.3 134.6 231.5 0 147-119.2 266.2-266.2 266.2S212.9 687.4 212.9 540.4c0-99.2 54.2-185.6 134.6-231.5l-14.7-26.1c-89.5 51-149.9 147.2-149.9 257.6 0 163.6 132.6 296.2 296.2 296.2S775.4 704 775.4 540.4c0-110.4-60.4-206.6-149.9-257.6z"/>
                    <path class="st0" d="M464.2 229h30v222.7h-30z"/>
                </g>
            </svg>
        </a>
    @endguest


    @auth()
        <a href="/home">
            <svg id="logo" class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080">
                <style>.st0 {
                        fill: #231f20
                    }</style>
                <g id="Layer_2">
                    <path class="st0" d="M862.9 159.5h30v761.7h-30zM980.5 159.5h30v761.7h-30z"/>
                    <path transform="rotate(-90 1249.168 367.704)" class="st0" d="M1234.2-57.8h30v851h-30z"/>
                    <path transform="rotate(-90 910.694 174.527)" class="st0" d="M895.7 153.1h30V196h-30z"/>
                    <path transform="rotate(-90 1029.09 174.527)" class="st0" d="M1014.1 153.9h30v41.2h-30z"/>
                    <path class="st0"
                          d="M1098.4 393.5h30v319.3h-30zM1518.3 393.5h30v319.3h-30zM1308.4 393.5h30v319.3h-30zM1203.4 393.5h30v319.3h-30zM1442.5 492.5h30v220.3h-30z"/>
                    <path transform="rotate(-90 1605.675 697.78)" class="st0" d="M1590.7 628.8h30v138h-30z"/>
                    <path transform="rotate(-90 1592.469 408.49)" class="st0" d="M1577.5 358.3h30v100.3h-30z"/>
                    <path transform="rotate(-90 1566.031 492.517)" class="st0" d="M1551 468.8h30v47.4h-30z"/>
                    <path transform="rotate(-90 1354.484 423.494)" class="st0" d="M1339.5 397.9h30v51.3h-30z"/>
                    <path class="st0" d="M1338.4 408.5h49.9c46.5 0 84.2 24 84.2 53.6v91.1"/>
                    <path transform="rotate(-90 1145.187 697.78)" class="st0" d="M1130.2 680.9h30v33.8h-30z"/>
                    <path class="st0"
                          d="M625.5 282.8l-14.7 26.1c80.4 45.8 134.6 132.3 134.6 231.5 0 147-119.2 266.2-266.2 266.2S212.9 687.4 212.9 540.4c0-99.2 54.2-185.6 134.6-231.5l-14.7-26.1c-89.5 51-149.9 147.2-149.9 257.6 0 163.6 132.6 296.2 296.2 296.2S775.4 704 775.4 540.4c0-110.4-60.4-206.6-149.9-257.6z"/>
                    <path class="st0" d="M464.2 229h30v222.7h-30z"/>
                </g>
            </svg>
        </a>
    @endauth

{{--                <a href="/login">--}}
{{--                    <img--}}
{{--                            id="logo"--}}
{{--                            src="/svg/offline.svg"--}}
{{--                            alt="Offline"--}}
{{--                            class=""--}}
{{--                    >--}}
{{--                </a>--}}


            <script>
                const particles = [];

                function setup() {
                    createCanvas(window.innerWidth, window.innerHeight);

                    const particlesLength = Math.floor(window.innerWidth / 10);

                    for(let i = 0; i < particlesLength; i++) {
                        particles.push(new Particle());
                    }
                }

                function draw() {
                    background('#4a5568');
                    particles.forEach((p, index) => {
                        p.update();
                        p.draw();
                        p.checkParticles(particles.slice(index));
                    });
                }

                class Particle {
                    constructor() {
                        // Position
                        this.pos = createVector(random(width), random(height));
                        // Velocity
                        this.vel = createVector(random(-2, 2), random(-2, 2));
                        // Size
                        this.size = 10;
                    }

                    // Update movement by adding velocity
                    update() {
                        this.pos.add(this.vel);
                        this.edges();
                    }

                    // Draw single particle
                    draw() {
                        noStroke();
                        fill('rgba(255,255,255,0.5)');
                        circle(this.pos.x, this.pos.y, this.size);
                    }

                    //Detect edges
                    edges() {
                        if(this.pos.x < 0 || this.pos.x > width) {
                            this.vel.x *= -1;
                        }

                        if(this.pos.y < 0 || this.pos.y > height) {
                            this.vel.y *= -1;
                        }
                    }

                    // Connect particles
                    checkParticles(particles) {
                        particles.forEach(particle => {
                            const d = dist(this.pos.x, this.pos.y, particle.pos.x, particle.pos.y);

// change < to > for crazy effect

                            if(d < 120) {
                                stroke('rgba(255,255,255,0.1)');
                                line(this.pos.x, this.pos.y, particle.pos.x, particle.pos.y);
                            }
                        });
                    }
                }

            </script>

    </body>
</html>

