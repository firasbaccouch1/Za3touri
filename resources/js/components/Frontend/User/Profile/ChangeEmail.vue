<template>
   <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">CHANGE EMAIL</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->


                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row row--center">
                            <div class="col-lg-6 col-md-8 u-s-m-b-30">
                                <div class="l-f-o">
                                    <div class="l-f-o__pad-box">
                                        <h1 class="gl-h1">New Email</h1>
                                        <form class="l-f-o__form">
                                            <div class="u-s-m-b-30">
                                            <ul class="dash__f-list">
                                                <li v-for="error in errors.email" :key='error.index'>
                                                    <span class="text-danger" >-  {{ error }}</span>
                                                </li>
                                            </ul>
                                                <label class="gl-label" for="reset-email">E-MAIL *</label>

                                                <input v-model="form.email" class="input-text input-text--primary-style" type="text" id="reset-email" placeholder="Enter E-mail">
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <button @click.prevent="ChangeEmail()" class="btn btn--e-transparent-brand-b-2" type="submit">SUBMIT</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->
        </div>
</template>
<script>
import Api from '../../../../app/frontend/Api/Api';
import { mapGetters } from 'vuex';
export default {
    data(){
        return {
            form:{
                email:'',
                token:'',
            },
            errors:{
                email:'',
        },
        }
    },computed: { 
            ...mapGetters({
        user: 'user',
    }),
    },methods:{
        ChangeEmail(){   
        Api.post('/Change-Email',this.form).then(res => {
            this.$toasted.show(res.data.msg)
                this.$store.commit('SET_AUTHENTICATED',false)
                this.$store.commit('SET_USER','')
             this.$router.push({name: "Login"})
        }).catch(err => {
            if (err.response.data.errors) {
                this.errors = err.response.data.errors
            }else{
                this.errors = [];
            this.$toasted.show(err.response.data.msg,{
                     type : 'error',
                    icon : 'exclamation-triangle'
               }) 
            }  
        })
        }
    },created(){
              var token = this.$route.params.token
              this.form.token =token
        Api.get('Check-Token/'+token).then(res => {

        }).catch(err => {
        this.$toasted.show(err.response.data.msg,{
            type : 'error',
            duration: 5000,
            icon : 'exclamation-triangle'
               }) 
        this.$router.push({name: "Home"})
        })
    }
}
</script>
<style scoped>
.text-danger{
    color: red;
    
}
</style>