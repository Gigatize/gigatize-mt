<template>
    <div class="px-3" id="page">
        <div class="container">
            <div class="card rounded-0 no-border py-1 px-3 mt-3 mb-3">
                <h1 class="mt-3">
                    Analyze App Exchange Portfolio in Salesforce<br />
                </h1>
                <h5 class="text-muted mb-3">The Global Sales Team needs help visualizing key insights for our total app spend per P&amp;L. We need two queries configured in SQL and the data to pull directly to Excel.</h5>
                <div class="divider gradient-teal-blue mb-1"></div>
                <div class="row no-gutters">
                    <div class="col col-lg-3">
                        <button type="button" class="btn btn-empty btn-block">
                            <font-awesome-icon icon="trophy" />&nbsp;
                            +500 Points
                        </button>
                    </div>
                    <div class="col col-lg-3">
                        <button type="button" class="btn btn-empty btn-block">
                            <font-awesome-icon icon="heart" />&nbsp;
                            20 Favorited
                        </button>
                    </div>
                    <div class="col col-lg-3">
                        <button type="button" class="btn btn-empty btn-block">
                            <font-awesome-icon icon="eye" />&nbsp;
                            10 Watching
                        </button>
                    </div>
                    <div class="col col-lg-3">
                        <button type="button" class="btn btn-empty btn-block">
                            <font-awesome-icon icon="comments" />&nbsp;
                            4 Comments
                        </button>
                    </div>
                </div>
            </div>
            <div class="row no-gutters align-items-stretch">
                <!-- Sidebar -->
                <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                    <div class="card rounded-0 no-border mr-3">
                        <div class="row align-items-start">
                            <div class="col-xs-12 col-sm-6 col-md-12 text-center">
                                <img src="images/graphics_and_design_icon.png" class="sidebar-icon mt-3" />
                                <div class="text-uppercase m-2">Graphics &amp; Design</div>
                                <div class="divider gradient-teal-blue mx-3"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-12 w-100">
                                <div class="pt-3 pr-3 pb-2 pl-3">
                                    <button type="button" class="btn btn-outline-secondary mb-1">Excel</button>
                                    <button type="button" class="btn btn-outline-secondary mb-1">SQL</button>
                                    <button type="button" class="btn btn-outline-secondary mb-1">SFDC</button>
                                    <button type="button" class="btn btn-outline-secondary mb-1">Data Analytics</button>
                                    <button type="button" class="btn btn-outline-secondary mb-1">Sales</button>
                                </div>
                                <div class="row no-gutters text-center">
                                    <div class="col card bg-light rounded-0 p-2" style="border-left: 0px;">
                                        <h4 class="text-blue mb-1">5</h4>
                                        <small style="font-size: 11px;">Days Until Start</small>
                                    </div>
                                    <div class="col card bg-light rounded-0 p-2" style="border-left: 0px;">
                                        <h4 class="text-blue mb-1">7</h4>
                                        <small style="font-size: 11px;">Estimated Hours</small>
                                    </div>
                                    <div class="col card bg-light rounded-0 p-2" style="border-left: 0px; border-right: 0px;">
                                        <h4 class="text-blue mb-1">20</h4>
                                        <small style="font-size: 11px;">Days Until Deadline</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-accent btn-xl rounded-0 btn-block text-uppercase">Make an Impact</button>
                    </div>
                </div>
                <!-- Main Content -->
                <div class="col-12 col-md-7 col-lg-8 col-xl-9 card rounded-0 no-border p-3">
                    <div class="w-100">
                        <h2>Logistics</h2>
                        <p>
                            The gig will kick off in <strong class="text-blue">5 days</strong> on <strong class="text-blue">4/30/2018</strong> and you will be one of <strong class="text-blue">3 members</strong> on the team. Completion of this gig is estimated to take <strong class="text-blue">5 hours</strong> per member.
                        </p>
                        <h5>You will gain <span class="badge badge-pill badge-accent">35 experience points</span> distributed among the following skillsets</h5>
                        <ul>
                            <li>Excel <span class="badge badge-pill badge-accent">+10</span></li>
                            <li>SQL <span class="badge badge-pill badge-accent">+5</span></li>
                            <li>SFDC <span class="badge badge-pill badge-accent">+5</span></li>
                            <li>Data Analytics <span class="badge badge-pill badge-accent">+10</span></li>
                            <li>Sales <span class="badge badge-pill badge-accent">+5</span></li>
                        </ul>
                        <h5>This gig will be complete when the following criteria has been met:</h5>
                        <ul style="list-style-type:square">
                            <li>Project is completed and submitted to team folder by deadline</li>
                            <li>Submission includes two queries that join the app spend and P&amp;L tables</li>
                            <li>Data must be able to refresh in Excel manually and automatically once per day</li>
                        </ul>
                        <hr class="p-0 my-3" />
                        <h2>Details</h2>
                        <p>
                            When our financial modeling guru left our team, we haven't been able to find a replacement and as such we are really behind schedule. You would be helping our team stay on target which would land us an extra 10% in contract profit by being able to launch quicker.
                        </p>
                        <hr class="p-0 my-3" />
                        <h2>More Information</h2>
                        <p>
                            This gig will be complete when the following criteria has been met:
                        </p>
                        <ul>
                            <li><input type="checkbox" />Complete a model that determines TAM, SAM, and potential market</li>
                            <li><input type="checkbox" />Must know how to use Excel Solver</li>
                        </ul>
                        <hr class="p-0 my-3" />
                        <h2>Team</h2>
                        <div class="d-flex justify-content-around text-center mb-3 flex-wrap">
                            <div class="px-3 pb-3 flex-shrink-0">
                                <div class="photo">
                                    <img src="http://placehold.it/400x400" />
                                </div>
                                <strong>Tobi Polland</strong>
                                <div>Gig Sponsor</div>
                            </div>
                            <div class="px-3 pb-3 flex-shrink-0">
                                <div class="photo">
                                    <img src="http://placehold.it/400x400" />
                                </div>
                                <strong>Tobi Polland</strong>
                                <div>Gig Sponsor</div>
                            </div>
                            <div class="px-3 pb-3 flex-shrink-0">
                                <div class="photo">
                                    <img src="http://placehold.it/400x400" />
                                </div>
                                <strong>Tobi Polland</strong>
                                <div>Gig Sponsor</div>
                            </div>
                            <div class="px-3 pb-3 flex-shrink-0">
                                <div class="photo">
                                    <img src="http://placehold.it/400x400" />
                                </div>
                                <strong>Tobi Polland</strong>
                                <div>Gig Sponsor</div>
                            </div>
                            <div class="px-3 pb-3 flex-shrink-0">
                                <div class="photo">
                                    <img src="http://placehold.it/400x400" />
                                </div>
                                <strong>Tobi Polland</strong>
                                <div>Gig Sponsor</div>
                            </div>
                            <div class="px-3 pb-3 flex-shrink-0">
                                <div class="photo">
                                    <img src="http://placehold.it/400x400" />
                                </div>
                                <strong>Tobi Polland</strong>
                                <div>Gig Sponsor</div>
                            </div>
                            <div class="px-3 pb-3 flex-shrink-0">
                                <div class="photo">
                                    <img src="http://placehold.it/400x400" />
                                </div>
                                <strong>Tobi Polland</strong>
                                <div>Gig Sponsor</div>
                            </div>
                        </div>
                        <hr class="p-0 my-3" />
                        <h2><font-awesome-icon icon="comments" />&nbsp;Comments</h2>
                        <ul class="list-unstyled mt-3">
                            <li class="media">
                                <img class="mr-3" src="http://placehold.it/40x40">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">Tobi Polland</h5>
                                    Wow, guys! Looks great!
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3" src="http://placehold.it/40x40">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">Tobi Polland</h5>
                                    Coming along nicely!
                                </div>
                            </li>
                        </ul>
                        <textarea rows="4"></textarea>
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
                gig: [
                ],
            }
        },
        computed: {
        },
        mounted(){
        },
        methods: {
        }
    }
</script>