<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Home
                    </div>

                    <div class="panel-body">

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

            }
        },
        mounted(){
            Promise.all([
                self.getUserData()
            ])
        },
        methods: {
            getUserData(){
                axios.get('/api/v1/user').then(response => {
                    console.log(response.data);
                });
            }
        }
    }
</script>