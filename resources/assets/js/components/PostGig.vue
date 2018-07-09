<template>
    <div class="px-3" id="page">
        <div class="container">
            <div class="card">
                <div class="my-4 progress-meter">
                    <div class="progress">
                        <div class="progress-bar bg-accent" role="progressbar" v-bind:style="{ width: progress }"></div>
                    </div>
                    <div class="d-flex justify-content-between steps">
                        <div class="text-center bg-white" v-on:click="changeTab('descriptionTab')">
                            <div class="rounded-circle mb-1 p-2 bg-secondary text-white d-inline-block step-count" v-bind:class="{ 'bg-accent': form.tab == 'descriptionTab' }">
                                1
                            </div>
                            <div class="small text-uppercase">Description</div>
                        </div>
                        <div class="text-center" v-on:click="changeTab('skillsAndImpactTab')">
                            <div class="px-3 d-inline-block bg-white">
                                <div class="rounded-circle mb-1 p-2 bg-secondary text-white step-count" v-bind:class="{ 'bg-accent': form.tab == 'skillsAndImpactTab' }">
                                    2
                                </div>
                            </div>
                            <div class="small text-uppercase">Skills &amp; Impact</div>
                        </div>
                        <div class="text-center bg-white" v-on:click="changeTab('finalizeTab')">
                            <div class="rounded-circle mb-1 p-2 bg-secondary text-white d-inline-block step-count" v-bind:class="{ 'bg-accent': form.tab == 'finalizeTab' }">
                                3
                            </div>
                            <div class="small text-uppercase">Finalize</div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid p-4" id="descriptionTab" v-if="form.tab == 'descriptionTab'">
                    <h4 class="text-center text-uppercase">Description</h4>
                    <div class="text-center text-uppercase small">Tell us about your gig</div>
                    <div class="px-4">
                        <div class="row">
                            <div class="col-xs-12 col-lg-6 pt-3">
                                <label class="text-uppercase">Gig Name *</label>
                                <input class="form-control" placeholder="Gig Name" v-model="gig.title" />
                            </div>
                            <div class="col-xs-12 col-lg-6 pt-3">
                                <label class="text-uppercase">Select a Category *</label>
                                <select class="form-control" placeholder="Category" v-model="gig.category_id">
                                    <option value=""></option>
                                    <option v-for="category in form.selectOptions.categories" v-bind:value="category.id" v-html="category.attributes.name"></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-lg-6 pt-3">
                                <label class="text-uppercase">Start Date *</label>
                                <input class="form-control" v-model="gig.start_date" />
                            </div>
                            <div class="col-xs-12 col-lg-6 pt-3">
                                <label class="text-uppercase">Deadline *</label>
                                <input class="form-control" v-model="gig.deadline" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 pt-3">
                                <label class="text-uppercase">Description *</label>
                                <textarea class="form-control" placeholder="Description" rows="6" v-model="gig.description"></textarea>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <button class="btn btn-lg btn-accent my-3 px-4 text-uppercase text-dark" type="button" v-on:click="changeTab('skillsAndImpactTab')" v-bind:disabled="step1Complete == false">Continue</button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid p-4" id="skillsAndImpactTab" v-if="form.tab == 'skillsAndImpactTab'">
                    <h4 class="text-center text-uppercase">Skills &amp; Impact</h4>
                    <div class="text-center text-uppercase small">Let's sort out the details</div>
                    <div class="px-4">
                        <div class="row">
                            <div class="col-xs-12 col-lg-6 pt-3">
                                <label class="text-uppercase">This gig is open to *</label>
                                <div class="form-check">
                                    <label>
                                        <input class="form-check-input" type="checkbox" value="0" v-model="gig.open_to">
                                        Anyone
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input class="form-check-input" type="checkbox" value="1" v-model="gig.open_to">
                                        Trainees
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input class="form-check-input" type="checkbox" value="2" v-model="gig.open_to">
                                        Beginners
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input class="form-check-input" type="checkbox" value="3" v-model="gig.open_to">
                                        Skilled
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input class="form-check-input" type="checkbox" value="4" v-model="gig.open_to">
                                        Experts
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-6 pt-3">
                                <label class="text-uppercase">How many people are allowed to sign up? *</label>
                                <div class="d-block">
                                    <div class="pr-3 d-inline-block">
                                        <img src="/images/user_active.svg" width="60px" v-on:click="gig.max_users = 1" v-if="gig.max_users >= 1" />
                                        <img src="/images/user.svg" width="60px" v-on:click="gig.max_users = 1" v-else />
                                    </div>
                                    <div class="pr-3 d-inline-block">
                                        <img src="/images/user_active.svg" width="60px" v-on:click="gig.max_users = 2" v-if="gig.max_users >= 2" />
                                        <img src="/images/user.svg" width="60px" v-on:click="gig.max_users = 2" v-else />
                                    </div>
                                    <div class="pr-3 d-inline-block">
                                        <img src="/images/user_active.svg" width="60px" v-on:click="gig.max_users = 3" v-if="gig.max_users >= 3" />
                                        <img src="/images/user.svg" width="60px" v-on:click="gig.max_users = 3" v-else />
                                    </div>
                                </div>

                                <label class="text-uppercase mt-3">How many hours per person? *</label>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-lg-4">
                                        <input class="form-control" type="number" v-model="gig.estimated_hours">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-lg-6 pt-3">
                                <label class="text-uppercase">This gig builds these skills </label>
                                <!-- <select class="form-control" placeholder="Category" v-model="gig.skills" multiple>
                                    <option v-for="skill in form.selectOptions.skills" v-bind:value="skill.id" v-html="skill.attributes.name"></option>
                                </select> -->
                                <div class="card h5 p-1 pr-0 mb-1 d-block">
                                    <div v-if="gig.skills.length == 0" class="text-muted" style="padding: 0.25em 0.4em;    font-size: 75%;">
                                        None Selected
                                    </div>
                                    <div class="badge badge-secondary mr-1" v-for="skill in form.selectOptions.skills" v-on:click="toggleSkill(skill)" v-if="gig.skills.indexOf(skill.id) > -1">{{ skill.attributes.name }} <font-awesome-icon icon="times-circle" /></div>
                                </div>
                                <div class="card m-0" style="overflow-y: auto; height: 160px;">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item p-2 rounded-0 text-dark" v-for="(skill, index) in form.selectOptions.skills" v-on:click="toggleSkill(skill)" v-bind:class="{ 'active': gig.skills.indexOf(skill.id) > -1 }">
                                            <div v-html="skill.attributes.name"></div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- <div class="input-group mt-2">
                                    <input type="text" class="form-control" placeholder="Add New Skill..." v-model="form.skills.value">
                                    <div class="input-group-append">
                                        <button class="btn btn-success px-3" type="button" v-on:click="addSkill">Add</button>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-xs-12 col-lg-6 pt-3">
                                <label class="text-uppercase">This gig will provide the following benefits*</label>
                                <div class="input-group">
                                    <textarea class="form-control" placeholder="Enter Benefits" v-model="gig.impact" rows="8"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <button class="btn btn-lg btn-outline-secondary my-3 px-4 text-uppercase" type="button" v-on:click="changeTab('descriptionTab')">Back</button>
                            <button class="btn btn-lg btn-accent my-3 px-4 text-uppercase text-dark" type="button" v-on:click="changeTab('finalizeTab')" v-bind:disabled="step2Complete == false">Continue</button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid p-4" id="finalizeTab" v-if="form.tab == 'finalizeTab'">
                    <h4 class="text-center text-uppercase">Finalize</h4>
                    <div class="text-center text-uppercase small">Get ready to post your gig!</div>
                    <div class="px-4">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 pt-3">
                                <label class="text-uppercase">Link to Gig Resources</label>
                                <input class="form-control" placeholder="http://" v-model="gig.resources_link" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 pt-3">
                                <label class="text-uppercase">Requirements for Gig Completion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Requirement..." v-model="form.acceptance_criteria.value">
                                    <div class="input-group-append">
                                        <button class="btn btn-success px-3" type="button" v-on:click="addAcceptanceCriteria">Add</button>
                                    </div>
                                </div>
                                <div class="border-bottom d-flex flex-row align-items-center px-3 py-2 small" v-for="(criterion, index) in gig.acceptance_criteria">
                                    <div v-html="criterion"></div>
                                    <div class="ml-auto">
                                        <button class="btn btn-danger btn-sm" type="button" v-on:click="removeAcceptanceCriteria(index)"><span class="fa fa-remove"></span>X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-lg-8 pt-3">
                                <label class="text-uppercase">Comments/Additional Information</label>
                                <textarea class="form-control" placeholder="" rows="6" v-model="gig.additional_info"></textarea>
                            </div>
                            <div class="col-xs-12 col-lg-4 pt-3">
                                <label class="text-uppercase d-none d-lg-block">&nbsp;</label>
                                <div class="form-check">
                                    <label>
                                        <input class="form-check-input" type="checkbox" v-model="gig.flexible_start">
                                        Flexible Start Date?
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input class="form-check-input" type="checkbox" v-model="gig.on_site">
                                        On Site?
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input class="form-check-input" type="checkbox" v-model="gig.renew">
                                        Potential to Renew Gig?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <button class="btn btn-lg btn-outline-secondary my-3 px-4 text-uppercase" type="button" v-on:click="changeTab('skillsAndImpactTab')">Back</button>
                            <button class="btn btn-lg btn-success my-3 px-4 text-uppercase text-white" type="button" v-on:click="">Submit</button>
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
                gig: {
                    title: 'asd',
                    category_id: '1',
                    description: 'aasdg',
                    start_date: 'asdgasdg',
                    deadline: 'asdgasdg',
                    impact: '',
                    skills: [],
                    open_to: [],
                    max_users: '',
                    estimated_hours: '',
                    resources_link: '',
                    acceptance_criteria: [], // added
                    additional_info: '',
                    flexible_start: false,
                    on_site: false,
                    renew: false
                },
                form: {
                    tab: 'descriptionTab',
                    selectOptions: {
                        categories: [],
                        skills: []
                    },
                    skills: {
                        error: false,
                        value: ''
                    },
                    acceptance_criteria: {
                        error: false,
                        value: ''
                    },
                }
            }
        },
        computed: {
            progress(){
                var self = this;
                var progress = 0;
                if (self.step1Complete){
                    progress = 50;

                    if (self.step2Complete){
                        progress = 100;
                    }
                }
                return progress + '%';
            },
            step1Complete(){
                var self = this;
                var requiredFields = [
                    'title',
                    'category_id',
                    'start_date',
                    'deadline',
                    'description'
                ];

                return self.isDataPopulated(requiredFields);
            },
            step2Complete(){
                var self = this;
                var requiredFields = [
                    'open_to',
                    'max_users',
                    'estimated_hours',
                    'skills',
                    'impact'
                ];

                return self.isDataPopulated(requiredFields);
            }
        },
        mounted(){
            var self = this;
            Promise.all([
                self.getCategories(),
                self.getSkills()
            ])
        },
        methods: {
            getCategories(){
                var self = this;
                return new Promise(async function(resolve, reject){
                    /*axios.get('/api/v1/categories').then(response => {
                        console.log(response.data.data);
                        resolve(response.data.data);
                    });*/
                    var response = {
                        "data": {
                            "categories": [
                                {
                                    "type": "category",
                                    "id": "1",
                                    "attributes": {
                                        "name": "Digital Marketing",
                                        "icon_path": "https://demo.gigatize-mt.dev/images/categories/digital_marketing_icon.png"
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/categories/1"
                                    }
                                },{
                                    "type": "category",
                                    "id": "2",
                                    "attributes": {
                                        "name": "Graphics and Design",
                                        "icon_path": "https://demo.gigatize-mt.dev/images/categories/graphics_and_design_icon.png"
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/categories/2"
                                    }
                                },{
                                    "type": "category",
                                    "id": "3",
                                    "attributes": {
                                        "name": "Tech and Development",
                                        "icon_path": "https://demo.gigatize-mt.dev/images/categories/tech_and_development_icon.png"
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/categories/3"
                                    }
                                },{
                                    "type": "category",
                                    "id": "4",
                                    "attributes": {
                                        "name": "Writing and Translation",
                                        "icon_path": "https://demo.gigatize-mt.dev/images/categories/writing_translation_icon.png"
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/categories/4"
                                    }
                                },{
                                    "type": "category",
                                    "id": "5",
                                    "attributes": {
                                        "name": "Data Analysis",
                                        "icon_path": "https://demo.gigatize-mt.dev/images/categories/data_analysis_icon.png"
                                    },
                                    "links": {
                                        "self": "https://demo.gigatize-mt.dev/api/v1/categories/5"
                                    }
                                }
                            ]
                        },
                        "links": {
                            "self": "https://demo.gigatize-mt.dev/api/v1/categories"
                        }
                    }
                    self.form.selectOptions.categories = response.data.categories;
                    resolve(self.form.selectOptions.categories);
                });
                
            },
            getSkills(){
                var self = this;
                return new Promise(async function(resolve, reject){
                    /*axios.get('/api/v1/skills').then(response => {
                        console.log(response.data.data);
                        resolve(response.data.data);
                    });*/
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
                    self.form.selectOptions.skills = response.data.skills;
                    resolve(self.form.selectOptions.skills);
                });
                
            },
            changeTab(tab){
                var self = this;
                if (tab == 'descriptionTab'){
                    self.form.tab = tab;
                } else if (tab == 'skillsAndImpactTab'){
                    if (self.step1Complete){
                        self.form.tab = tab;
                    }
                } else if (tab == 'finalizeTab'){
                    if (self.step2Complete){
                        self.form.tab = tab;
                    }
                }
            },
            isDataPopulated(fields){
                var self = this;

                var areFieldsPopulated = fields.filter(function(field){
                    if ($.isArray(self.gig[field]) || typeof self.gig[field] == 'string'){
                        return self.gig[field].length > 0;
                    } else if ($.isNumeric(self.gig[field])){
                        return true;
                    }
                });

                return areFieldsPopulated.length == fields.length;
            },
            toggleSkill(skill){
                var self = this;
                if (self.gig.skills.indexOf(skill.id) > -1){
                    self.gig.skills.splice(self.gig.skills.indexOf(skill.id), 1)
                } else {
                    self.gig.skills.push(skill.id);
                }
            },
            addSkill(){
                var self = this;
                return new Promise(async function(resolve, reject){
                    if (self.form.skills.value.length == 0){
                        self.form.skills.error = true;
                    } else {
                        /*axios.post('/api/v1/skills', {
                            params: {
                                name: self.form.skills.value
                            }
                        }).then(response => {
                            console.log(response);
                            self.form.skills.error = false;
                            self.selectOptions.skills.push(self.form.skills.value);
                            self.form.skills.value = '';
                        });*/
                        var response = {
                            "data": {
                                "type": "skill",
                                "id": self.form.skills.value,
                                "attributes": {
                                    "name": self.form.skills.value,
                                    "created_at": new Date(),
                                    "updated_at": new Date()
                                },
                                "links": {
                                    "self": "https://demo.gigatize-mt.dev/api/v1/skills/0"
                                }
                            }
                        }
                        self.form.selectOptions.skills.push(response.data);
                        self.gig.skills.push(self.form.skills.value);
                        self.form.skills.error = false;
                        self.form.skills.value = '';
                    }
                });
            },
            removeSkill(index) {
                var self = this;
                self.gig.skills.splice(index, 1);
            },
            addAcceptanceCriteria(){
                var self = this;
                if (self.form.acceptance_criteria.value.length == 0){
                    self.form.acceptance_criteria.error = true;
                } else {
                    self.form.acceptance_criteria.error = false;
                    self.gig.acceptance_criteria.push(self.form.acceptance_criteria.value);
                    self.form.acceptance_criteria.value = '';
                }
            },
            removeAcceptanceCriteria(index) {
                var self = this;
                self.gig.acceptance_criteria.splice(index, 1);
            }
        }
    }
</script>