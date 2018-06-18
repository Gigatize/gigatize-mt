<template>
    <div class="px-3" id="page">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border rounded mb-3">
                <a class="navbar-brand" href="#">Filters</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFilter" aria-controls="navbarFilter" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarFilter">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="categoryFilterDropdown" style="min-width: 280px;">
                                <div class="p-3">
                                    <div class="form-check" v-for="option in filters.category.options">
                                        <label>
                                            <input class="form-check-input" type="checkbox" v-bind:value="option.id" v-model="filters.category.active">
                                            {{ option.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="pointsFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Points
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pointsFilterDropdown" style="min-width: 280px;">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col-xs-5 col-sm-5">
                                            <input type="number" class="form-control" v-model="filters.points.low" min="0" max="99" />
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            to
                                        </div>
                                        <div class="col-xs-5 col-sm-5">
                                            <input type="number" class="form-control" v-model="filters.points.high" min="1" max="100" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="startDateFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Start Date
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="startDateFilterDropdown" style="min-width: 220px;">
                                <div class="p-3">
                                    <div class="mt-1">
                                        <input type="date" class="form-control" v-model="filters.start_date.low" />
                                    </div>
                                    <div class="text-center mt-1">
                                        to
                                    </div>
                                    <div>
                                        <input type="date" class="form-control" v-model="filters.start_date.high" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="deadlineFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Deadline
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="deadlineFilterDropdown" style="min-width: 220px;">
                                <div class="p-3">
                                    <div class="mt-1">
                                        <input type="date" class="form-control" v-model="filters.deadline.low" />
                                    </div>
                                    <div class="text-center mt-1">
                                        to
                                    </div>
                                    <div>
                                        <input type="date" class="form-control" v-model="filters.deadline.high" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="sortByFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort By
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortByFilterDropdown" style="min-width: 220px;">
                                <div class="p-3">
                                    <div class="form-check" v-for="option in filters.sortBy.options">
                                        <label>
                                            <input class="form-check-input" type="radio" v-bind:value="option.id" v-model="filters.sortBy.active">
                                            {{ option.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <form class="form-inline pl-1">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" v-model="filters.search.value">
                                <div class="input-group-append">
                                    <span class="input-group-text">S</span>
                                </div>
                            </div>
                        </form>
                    </ul>
                </div>
            </nav>
            <div class="card px-3">
                <div class="row align-items-stretch">
                    <div class="col-xs-12 col-md-6 col-lg-4 py-3" v-for="gig in filteredGigs">
                        <div class="card h-100">
                            <div class="card-header flex-grow-0 flex-shrink-0 text-right" v-bind:class="gig.color">
                                {{ gig.achievements.length }} *trophy*
                                <br />
                                6 days *calendar*
                            </div>
                            <div class="card-body flex-grow-1">
                                <h2>{{ gig.title }}</h2>
                                <p>{{ gig.description }}</p>
                            </div>
                            <div class="card-body d-flex align-items-top border-top py-2 flex-grow-0 flex-shrink-0">
                                <div>
                                    Skills:
                                    <div class="d-inline-block">
                                        <div class="badge badge-secondary p-1 mr-1" v-for="skill in gig.skills">{{ skill }}</div>
                                    </div>
                                </div>
                                <div class="ml-auto flex-grow-0 flex-shrink-0">
                                    {{ gig.comments.length }} *C* {{ gig.favorites }} *H*
                                </div>
                            </div>
                            <div class="card-footer p-0 flex-grow-0 flex-shrink-0">
                                <a class="btn btn-block btn-secondary text-white rounded-0">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                filters: {
                    category: {
                        active: [],
                        options: [
                            {
                                id: 'digital_marketing',
                                name: 'Digital Marketing'
                            }, {
                                id: 'graphics_and_design',
                                name: 'Graphics and Design'
                            }, {
                                id: 'tech_and_development',
                                name: 'Tech and Development'
                            }, {
                                id: 'writing_and_translation',
                                name: 'Writing and Translation'
                            }, {
                                id: 'data_analysis',
                                name: 'Data Analysis'
                            }
                        ]
                    },
                    points: {
                        low: 0,
                        high: 100
                    },
                    start_date: {
                        low: '',
                        high: ''
                    },
                    deadline: {
                        low: '',
                        high: ''
                    },
                    sortBy: {
                        active: '',
                        options: [
                            {
                                id: 'relevance',
                                name: 'Relevance'
                            }, {
                                id: 'points',
                                name: 'Points'
                            }, {
                                id: 'favorites',
                                name: 'Favorites'
                            }, {
                                id: 'start_date',
                                name: 'Start Date'
                            }, {
                                id: 'sponsored',
                                name: 'Sponsored'
                            }
                        ]
                    },
                    search: {
                        value: ''
                    }
                },
                gigs: [
                    {
                        title: 'Ruby Network Bots',
                        description: 'The Cyber Security Architecture Team is seeking someone with experience in Ruby on Rails to help with a network bot that will verify AWS trusted relationships. We will pair you with our team\'s network...',
                        skills: ['Ruby', 'Cyber Security'],
                        comments: [],
                        favorites: 0,
                        achievements: [],
                        deadline: '7/1/2018',
                        points: 1,
                        category_id: 'tech_and_development',
                        color: 'gradient-yellow-orange',
                    },{
                        title: 'Polymer UI Decoupling',
                        description: 'We need help decoupling UI elements from Polymer due to technical debt and performance issues.',
                        skills: ['HTML', 'CSS', 'JavaScript'],
                        comments: [],
                        favorites: 0,
                        achievements: [],
                        deadline: '7/1/2018',
                        points: 10,
                        category_id: 'tech_and_development',
                        color: 'gradient-yellow-orange',
                    },{
                        title: 'Logo Design for Digital Spotlight',
                        description: 'We need a logo for our "Digital Spotlight" event series which will feature products from each business across all of our office locations during the month of August. Our theme this year is Outer Space...',
                        skills: ['Logo', 'Design Thinking', 'Graphic Design'],
                        comments: [],
                        favorites: 0,
                        achievements: [],
                        deadline: '7/1/2018',
                        points: 50,
                        category_id: 'graphics_and_design',
                        color: 'gradient-blue-teal',
                    }
                ]
            }
        },
        computed: {
            filteredGigs(){
                var self = this;
                var gigs = [];
                for (var i = 0; i < self.gigs.length; i++){
                    var gig = self.gigs[i];
                    var gigFail = false;
                    if (self.filters.category.active.length > 0){
                        if ($.inArray(gig.category_id, self.filters.category.active) == -1){
                            gigFail = true;
                        }
                    }
                    if (self.filters.points.low > gig.points){
                        gigFail = true;
                    }
                    if (self.filters.points.high < gig.points){
                        gigFail = true;
                    }
                    if (self.filters.search.value.length > 0){
                        if (gig.title.toLowerCase().indexOf(self.filters.search.value.toLowerCase()) == -1 && gig.description.toLowerCase().indexOf(self.filters.search.value.toLowerCase()) == -1){
                            gigFail = true;
                        }
                    }
                    if (gigFail == false){
                        gigs.push(gig);
                    }
                }
                return gigs;
            }
        },
        mounted(){
            this.getAndSetProjects()
        },
        methods: {
            getAndSetProjects(){
                var self = this;
                return new Promise(async function(resolve, reject){
                    axios.get('/api/v1/projects').then(response => {
                        resolve(response.data.data);
                    });
                });
            }
        }
    }
</script>