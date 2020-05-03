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
    <body class="bg-gray-700">

                <a href="/login">
                    <img
                            id="logo"
                            src="/img/offline.svg"
                            alt=""
                            class=""
                    >
                </a>

            <flash message="{{ session('flash') }}"></flash>

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
                        fill('rgba(255,255,255,0.5');
                        circle(this.pos.x, this.pos.y, this.size)
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

                            if(d > 120) {
                                stroke('rgba(255,255,255,0.1)');
                                line(this.pos.x, this.pos.y, particle.pos.x, particle.pos.y);
                            }
                        });
                    }
                }

            </script>

    </body>
</html>

