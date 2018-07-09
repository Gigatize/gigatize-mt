<template>
    <div class="px-3" id="page">
        <div class="container-fluid">
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
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="categoryFilterDropdown" style="min-width: 280px;">
                                <div class="p-3">
                                    <div class="form-check" v-for="option in filters.category.options">
                                        <label>
                                            <input class="form-check-input" type="checkbox" v-bind:value="option.id" v-model="filters.category.active">
                                            {{ option.name }}
                                        </label>
                                    </div>
                                    <button class="btn btn-block btn-sm btn-outline-secondary mt-2" v-on:click="filters.category.active = []">Clear</button>
                                </div>
                            </div>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="pointsFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Points
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="pointsFilterDropdown" style="min-width: 280px;">
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
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="startDateFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Start Date
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="startDateFilterDropdown" style="min-width: 220px;">
                                <div class="p-3">
                                    <div class="mt-1">
                                        <date-picker v-model="filters.start_date.low" format="MM/DD/YYYY" lang="en"></date-picker>
                                    </div>
                                    <div class="text-center mt-1">
                                        to
                                    </div>
                                    <div>
                                        <date-picker v-model="filters.start_date.high" format="MM/DD/YYYY" lang="en"></date-picker>
                                    </div>
                                    <button class="btn btn-block btn-sm btn-outline-secondary mt-2" v-on:click="filters.start_date.low = null; filters.start_date.high = null;">Clear</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="deadlineFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Deadline
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="deadlineFilterDropdown" style="min-width: 220px;">
                                <div class="p-3">
                                    <div class="mt-1">
                                        <date-picker v-model="filters.deadline.low" format="MM/DD/YYYY" lang="en"></date-picker>
                                    </div>
                                    <div class="text-center mt-1">
                                        to
                                    </div>
                                    <div>
                                        <date-picker v-model="filters.deadline.high" format="MM/DD/YYYY" lang="en"></date-picker>
                                    </div>
                                    <button class="btn btn-block btn-sm btn-outline-secondary mt-2" v-on:click="filters.deadline.low = null; filters.deadline.high = null;">Clear</button>
                                </div>
                            </div>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="sortByFilterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort By
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="sortByFilterDropdown" style="min-width: 220px;">
                                <div class="p-3">
                                    <div class="form-check" v-for="option in filters.sortBy.options">
                                        <label>
                                            <input class="form-check-input" type="radio" v-bind:value="option.id" v-model="filters.sortBy.active">
                                            {{ option.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li> -->
                        <form class="form-inline pl-1">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" v-model="filters.search.value">
                                <div class="input-group-append">
                                    <span class="input-group-text"><font-awesome-icon icon="search" /></span>
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
                            <div class="card-header flex-grow-0 flex-shrink-0 d-flex flex-column" v-bind:class="gig.attributes.color">
                                <div class="d-flex align-items-center justify-content-end">
                                    {{ gig.attributes.computed.followers_count }} <font-awesome-icon icon="trophy" pull="right" fixed-width />
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    6 days <font-awesome-icon icon="calendar" pull="right" fixed-width />
                                </div>
                            </div>
                            <div class="card-body flex-grow-1">
                                <h2>{{ gig.attributes.title }}</h2>
                                <p>{{ gig.attributes.description }}</p>
                            </div>
                            <div class="card-body d-flex align-items-top border-top py-2 flex-grow-0 flex-shrink-0">
                                <div>
                                    Skills:
                                    <div class="d-inline-block">
                                        <div class="badge badge-secondary p-1 mr-1" v-if="gig.attributes.skills.length > 0 && options.skills.length > 0" v-for="skill in gig.attributes.skills.slice(0,3)">{{ options.skills.filter(function(option){return skill == option.id})[0].attributes.name }}</div>
                                        <div class="badge badge-secondary py-1 px-2 mr-1" v-if="gig.attributes.skills.length > 3 && options.skills.length > 0" v-bind:title="joinSkills(gig.attributes.skills.slice(3))">...</div>
                                    </div>
                                </div>
                                <div class="ml-auto flex-grow-0 flex-shrink-0">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 pr-1" v-on:click="toggleUpvote(gig)">
                                            {{ gig.attributes.computed.upvotes_count }} <font-awesome-icon icon="arrow-up" title="Upvote Gig"/>
                                        </div>
                                        <div class="flex-shrink-0" v-on:click="toggleFavorite(gig)">
                                            {{ gig.attributes.computed.followers_count }} <font-awesome-icon icon="plus" title="Follow Gig"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-0 flex-grow-0 flex-shrink-0">
                                <a class="btn btn-block btn-secondary text-white rounded-0">
                                    <font-awesome-icon icon="eye"/> View Details
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
    import DatePicker from 'vue2-datepicker';
    export default {
        data(){
            return {
                filters: {
                    category: {
                        active: [],
                        options: [
                            {
                                id: '0',
                                name: 'Digital Marketing'
                            }, {
                                id: '1',
                                name: 'Graphics and Design'
                            }, {
                                id: '2',
                                name: 'Tech and Development'
                            }, {
                                id: '3',
                                name: 'Writing and Translation'
                            }, {
                                id: '4',
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
                options: {
                    skills: []
                },
                gigs: [
                    {
                        type: 'projects',
                        id: '0',
                        attributes: {
                            'title': 'Ruby Network Bots',
                            'slug': 'ruby-network-bots',
                            'description': 'The Cyber Security Architecture Team is seeking someone with experience in Ruby on Rails to help with a network bot that will verify AWS trusted relationships. We will pair you with our team\'s network...',
                            "start_date": "2018-04-25",
                            "deadline": "2018-06-25",
                            "impact": "Lorem ipsum dolor sit emet",
                            "max_users": "3",
                            "estimated_hours": "20",
                            "flexible_start": true,
                            "on_site": false,
                            "renew": false,
                            "status": "Not Started",
                            "started": false,
                            "complete": false,
                            "updated_at": "2018-06-15 01:07:27",
                            "created_at": "2018-06-15 01:07:27",
                            "computed": {
                                "total_points": "20",
                                "project_users": "0",
                                "comments_count": "0",
                                "upvotes_count": "0",
                                "followers_count": "0"
                            },
                            'skills': [0, 1, 5],
                            'category_id': '2',
                            'color': 'gradient-yellow-orange'
                        },
                        links: {
                            "self": "https://demo.gigatize-mt.dev/api/v1/projects/0"
                        }
                    },{
                        type: 'projects',
                        id: '1',
                        attributes: {
                            'title': 'Polymer UI Decoupling',
                            'slug': 'polymer-ui-decoupling',
                            'description': 'We need help decoupling UI elements from Polymer due to technical debt and performance issues.',
                            "start_date": "2018-05-25",
                            "deadline": "2018-07-25",
                            "impact": "Lorem ipsum dolor sit emet",
                            "max_users": "3",
                            "estimated_hours": "20",
                            "flexible_start": true,
                            "on_site": false,
                            "renew": false,
                            "status": "Not Started",
                            "started": false,
                            "complete": false,
                            "updated_at": "2018-06-15 01:07:27",
                            "created_at": "2018-06-15 01:07:27",
                            "computed": {
                                "total_points": "20",
                                "project_users": "0",
                                "comments_count": "0",
                                "upvotes_count": "0",
                                "followers_count": "0"
                            },
                            'skills': [2, 3, 4, 5],
                            'category_id': '3',
                            'color': 'gradient-teal-blue'
                        },
                        links: {
                            "self": "https://demo.gigatize-mt.dev/api/v1/projects/0"
                        }
                    },{
                        type: 'projects',
                        id: '2',
                        attributes: {
                            'title': 'Logo Design for Digital Spotlight',
                            'slug': 'logo-design-for-digital-spotlight',
                            'description': 'We need a logo for our "Digital Spotlight" event series which will feature products from each business across all of our office locations during the month of August. Our theme this year is Outer Space...',
                            "start_date": "2018-06-25",
                            "deadline": "2018-07-25",
                            "impact": "Lorem ipsum dolor sit emet",
                            "max_users": "3",
                            "estimated_hours": "20",
                            "flexible_start": true,
                            "on_site": false,
                            "renew": false,
                            "status": "Not Started",
                            "started": false,
                            "complete": false,
                            "updated_at": "2018-06-15 01:07:27",
                            "created_at": "2018-06-15 01:07:27",
                            "computed": {
                                "total_points": "20",
                                "project_users": "0",
                                "comments_count": "0",
                                "upvotes_count": "0",
                                "followers_count": "0"
                            },
                            'skills': [0, 1, 4, 5],
                            'category_id': '3',
                            'color': 'gradient-teal-blue'
                        },
                        links: {
                            "self": "https://demo.gigatize-mt.dev/api/v1/projects/0"
                        }
                    }
                ]
            }
        },
        components: {
            DatePicker
        },
        computed: {
            filteredGigs(){
                var self = this;
                var gigs = [];
                for (var i = 0; i < self.gigs.length; i++){
                    var gig = self.gigs[i];
                    var gigFail = false;
                    // category
                    if (self.filters.category.active.length > 0){
                        if ($.inArray(gig.attributes.category_id, self.filters.category.active) == -1){
                            gigFail = true;
                        }
                    }
                    // points
                    if (self.filters.points.low > gig.points){
                        gigFail = true;
                    }
                    if (self.filters.points.high < gig.points){
                        gigFail = true;
                    }
                    // start date
                    var gigStartDate = new Date(gig.attributes.start_date);
                    if (self.filters.start_date.low){
                        var filterStartDateLow = new Date(self.filters.start_date.low);
                        if (filterStartDateLow > gigStartDate){
                            gigFail = true;
                        }
                    }
                    if (self.filters.start_date.high){
                        var filterStartDateHigh = new Date(self.filters.start_date.high);
                        if (filterStartDateHigh < gigStartDate){
                            gigFail = true;
                        }
                    }
                    // deadline
                    var gigDeadline = new Date(gig.attributes.deadline);
                    if (self.filters.deadline.low){
                        var filterDeadlineLow = new Date(self.filters.deadline.low);
                        if (filterDeadlineLow > gigDeadline){
                            gigFail = true;
                        }
                    }
                    if (self.filters.deadline.high){
                        var filterDeadlineHigh = new Date(self.filters.deadline.high);
                        if (filterDeadlineHigh < gigDeadline){
                            gigFail = true;
                        }
                    }
                    // search
                    if (self.filters.search.value.length > 0){
                        if (gig.attributes.title.toLowerCase().indexOf(self.filters.search.value.toLowerCase()) == -1){
                            gigFail = true;
                        }
                        if (gig.attributes.description.toLowerCase().indexOf(self.filters.search.value.toLowerCase()) == -1){
                            gigFail = true;
                        }
                    }
                    if (gigFail == false){
                        gigs.push(gig);
                    }
                }
                // sorting
                var key = self.filters.sortBy.active;
                if (key.length > 0){
                    gigs = gigs.sort(function(a, b){
                        var key1 = a.attributes[key];
                        var key2 = b.attributes[key];
                        if ($.isNumeric(key1) && $.isNumeric(key2)){
                            return key1 - key2;
                        } else {
                            if (key1 > key2){
                                return -1;
                            } else if (key1 < key2) {
                                return 1;
                            } else {
                                return 0;
                            }
                        }
                    });
                }
                return gigs;
            }
        },
        mounted(){
            Promise.all([
                this.getAndSetProjects(),
                this.getSkills()
            ])
        },
        methods: {
            getAndSetProjects(){
                var self = this;
                return new Promise(async function(resolve, reject){
                    axios.get('/api/v1/projects').then(response => {
                        resolve(response.data.data);
                    });
                });
            },
            getSkills(){
                var self = this;
                return new Promise(async function(resolve, reject){
                    var response = {
                        "data": {
                            'skills': [
                                {
                                    "type": "skill",
                                    "id": '0',
                                    "attributes": {
                                        "name": 'Graphic Design',
                                        "created_at": new Date(),
                                        "updated_at": new Date()
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/skills/0"
                                    }
                                },{
                                    "type": "skill",
                                    "id": '1',
                                    "attributes": {
                                        "name": 'Project Management',
                                        "created_at": new Date(),
                                        "updated_at": new Date()
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/skills/1"
                                    }
                                },{
                                    "type": "skill",
                                    "id": '2',
                                    "attributes": {
                                        "name": 'Testing',
                                        "created_at": new Date(),
                                        "updated_at": new Date()
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/skills/2"
                                    }
                                },{
                                    "type": "skill",
                                    "id": '3',
                                    "attributes": {
                                        "name": 'Data Analysis',
                                        "created_at": new Date(),
                                        "updated_at": new Date()
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/skills/3"
                                    }
                                },{
                                    "type": "skill",
                                    "id": '4',
                                    "attributes": {
                                        "name": 'Mapping',
                                        "created_at": new Date(),
                                        "updated_at": new Date()
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/skills/4"
                                    }
                                },{
                                    "type": "skill",
                                    "id": '5',
                                    "attributes": {
                                        "name": 'Organization',
                                        "created_at": new Date(),
                                        "updated_at": new Date()
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/skills/5"
                                    }
                                }
                            ]
                        }
                    }
                    self.options.skills = response.data.skills;
                    resolve(self.options.skills);
                })
            },
            joinSkills(skills){
                var self = this;
                var response = [];
                for (var i = 0; i < skills.length; i++){
                    response.push(self.options.skills.filter(function(option){
                        return skills[i] == option.id
                    })[0].attributes.name)
                }
                return response.join('\n')
            },
            toggleFavorite(gig){
                var self = this;
                return new Promise(async function(resolve, reject){
                    gig.favorite = !gig.favorite;
                });
            },
            toggleUpvote(gig){
                var self = this;
                return new Promise(async function(resolve, reject){
                    // gig.favorite = !gig.favorite;
                    resolve(gig);
                });
            },
        }
    }
</script>