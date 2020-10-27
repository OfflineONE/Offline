<header class="h-24 flex items-center justify-between bg-gray-300">
   <div class="level">
       <a href="/home">
           <svg class="h-12 w-24" viewBox="0 0 1920 1080" xmlns="http://www.w3.org/2000/svg">
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

       @auth()

       <searchbar inline-template>
           <ais-index
                   app-id="{{ config('scout.algolia.id') }}"
                   api-key="{{ config('scout.algolia.key') }}"
                   index-name="threads"
                   query="{{ request('q') }}"
                   class="relative"
           >
               <div class="flex py-2 ml-2">
                   <div class="flex-initial">

                       <div @click="ResultsAreOpen = !ResultsAreOpen" class="relative z-10 form-control">
                           <ais-search-box class="">
                               <ais-input :autofocus="true" placeholder="Find Offers..."
                                          class="focus:outline-none "></ais-input>
                           </ais-search-box>
                       </div>
                   </div>

                   {{--               <div class="flex-1">--}}
                   {{--                   <div class="">--}}
                   {{--                       Filter by channel--}}
                   {{--                   </div>--}}

                   {{--                   <div class="">--}}
                   {{--                       <ais-refinement-list attribute-name="channel.name" :autofocus="true"></ais-refinement-list>--}}
                   {{--                   </div>--}}
                   {{--               </div>--}}

               </div>

               <button v-if="ResultsAreOpen"
                       @click="ResultsAreOpen = false"
                       tabindex="-1"
                       class="fixed opacity-50 top-0 right-0 left-0 bottom-0 h-full w-full bg-black cursor-default"></button>

               <ais-results v-if="ResultsAreOpen"
                            class="absolute bg-white rounded-lg py-1 shadow-xl">
                   <template scope="{ result }">
                       <dt class="block hover:bg-indigo-500 ">
                           <a :href="result.path" class="block px-2 py-1 focus:bg-indigo-500 focus:text-white focus:outline-none hover:text-white hover:no-underline">
                               <ais-highlight :result="result"
                                              attribute-name="title"></ais-highlight>
                           </a>
                       </dt>
                   </template>
               </ais-results>

           </ais-index>
       </searchbar>
   </div>

    <div class="level">

        <channel-dropdown></channel-dropdown>

{{--        Browse Threads--}}

        <div class="sm:invisible md:invisible lg:visible xl:visible">
            <div class="dropdown mr-5">

                <a href="#"
                   class="dropdown-toggle ml-4 bg-blue-500 border-white hover:no-underline hover:bg-blue-400 rounded-full text-white px-2 py-0.8 text-lg"
                   data-toggle="dropdown"
                   role="button"
                   aria-haspopup="true"
                   aria-expanded="false"
                >
                    Offers
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a href="/threads">All Offers</a></li>

                    @if (auth()->check())
                        <li><a href="/threads?by={{ auth()->user()->name }}">My Offers</a></li>
                    @endif

                    <li><a href="/threads?popular=1">Popular Offers</a></li>
                    <li><a href="/threads?unanswered=1">Unanswered Offers</a></li>
                </ul>
            </div>
        </div>

        <div class="sm:invisible md:invisible lg:visible xl:visible">
            <a href="/threads/create"
               class="ml-4 bg-blue-500 border-white hover:no-underline hover:bg-blue-400 rounded-full text-white px-2 py-0.8 text-lg"
            >
                Create Offer
            </a>
        </div>

    </div>

@endauth()

    <div>
        @if (Auth::check())

        <div class="level">
            <div class="mr-56">
                <user-notifications></user-notifications>

                @if (Auth::user()->isAdmin())
                        <a href="/admin">
                            <svg class="h-6 w-6"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 512 512">
                                <circle cx="256" cy="256" r="256" fill="#ff7069"/><path d="M369.778 429.949l-19.875-85.516s68.194-65.641 60.536-149.88c-7.658-84.057-92.444-137.117-178.507-114.142s-100.285 91.897-100.65 103.202c-.365 11.305 10.211 40.296 2.553 59.989-7.658 19.692-35.009 50.689-32.456 59.989 2.553 9.299 26.074 10.758 26.074 10.758s.365 8.934-2.917 10.758c-3.1 1.823-1.276 9.299 3.829 13.493s13.675 6.929 13.675 6.929-9.846 2.188-8.57 9.299c1.276 6.929 4.741 10.576 12.034 10.758 7.293.365 9.299-3.1 10.576.729s2.006 4.194 2.006 4.194-7.293 18.963-.912 33.003c6.382 14.04 16.228 14.04 27.715 11.122s33.732-9.299 33.732-9.299l6.017 31.179c6.382 45.219-24.433 68.558-25.162 69.105a260.266 260.266 0 0056.342 6.199c57.071 0 109.584-18.598 152.251-50.142-4.011-2.006-37.014-30.268-38.473-31.726h.182z" fill="#ecf0f1"/><g fill="#e4e7ed"><path d="M159.179 407.521c6.382 10.029 15.316 9.846 25.709 7.293 11.487-2.917 33.732-9.299 33.732-9.299l6.017 31.18c2.188 15.499 0 28.262-3.829 38.655 21.333-30.45 5.652-53.607 8.387-65.094s47.407-22.427 56.707-29.538c9.299-7.111 16.046-26.986 16.046-26.986s-9.299 14.405-19.328 23.157-87.521 31.544-102.291 36.467c-14.04 4.741-20.786-4.558-21.333-5.47l.183-.365zM210.598 87.704c53.607-19.692 117.06-9.117 155.533 30.268 45.949 46.86 56.524 132.376-23.521 222.632l26.986 89.345-19.875-85.516s68.194-65.641 60.536-149.88c-7.658-84.057-92.444-137.117-178.507-114.142-7.658 2.006-14.587 4.376-21.151 7.111v.182z"/></g><path d="M340.057 276.422c86.61-92.627-9.664-246.336-161.003-138.029 0 0 42.12-5.288 59.259 15.681 23.522 28.809-9.663 109.766 101.744 122.348z" fill="#5fdc68"/><path d="M213.698 117.607c-11.122 5.47-22.792 12.399-34.644 20.786 0 0 42.12-5.288 59.259 15.681 6.564 7.84 8.752 19.875 10.758 33.003 2.37-12.764-.365-61.994-35.373-69.652v.182z" fill="#56bf5d"/><path d="M338.598 276.239c-.547-65.094-24.433-160.091-90.986-154.256 69.835-9.664 97.915 80.775 99.556 146.234l.912 18.781-9.299 2.735-.182-13.311v-.183z" fill="#6c7678"/>
                            </svg>
                        </a>
                @endif
            </div>
        </div>

            <avatar inline-template>

                <div class="absolute top-0 right-0">
                    <button @click="isOpen = !isOpen"
                            class="block h-48 w-48 rounded-bl-full overflow-hidden border-gray-100 border-4 focus:outline-none focus:border-pink-700">
                        <img
                            class="h-full w-full object-cover"
                            src="{{ auth()->user()->avatar_path }}"
                            alt="{{ auth()->user()->name }}">
                    </button>
{{--                    cloak div needed to change to div instead of button to override default cursor property what was not possible with cursor-default and button--}}
                    <div v-if="isOpen"
                         @click="isOpen = false" class="fixed right-0 top-0 left-0 top-0 h-full w-full cursor-default">

                    </div>

                    <div v-if="isOpen"
                         class="absolute right-0 py-2 w-32 mt-2 bg-white rounded-lg shadow-2xl"
                    >

                        <a class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:no-underline hover:text-white"
                           href="{{ route('profile.show', auth()->user()) }}"
                        >
                            My Profile
                        </a>

                        <a href="/logout"
                           class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:no-underline hover:text-white"
                           onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"
                        >
                            Logout
                        </a>

                        <form id="logout-form"
                              action="/logout"
                              method="POST"
                              style="display: none;">

                            @csrf
                        </form>
                    </div>
                </div>

            </avatar>

            @endif
    </div>

</header>
