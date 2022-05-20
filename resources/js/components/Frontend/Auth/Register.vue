<template>
    <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">

                                        <router-link :to="{name:'Home'}">Home</router-link></li>
                                    <li class="is-marked">

                                        <router-link :to="{name:'Register'}">Signup</router-link></li>
                                </ul>
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
                                    <h1 class="section__heading u-c-secondary">CREATE AN ACCOUNT</h1>
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
                                        <h1 class="gl-h1">PERSONAL INFORMATION</h1>
                                        <form class="l-f-o__form">
                                            <div class="gl-s-api">
                                                <div class="u-s-m-b-15">

                                                    <a  href ="/Login/facebook" class="gl-s-api__btn gl-s-api__btn--fb" type="button"><i class="fab fa-facebook-f"></i>

                                                        <span>Signup with Facebook</span></a></div>
                                                <div class="u-s-m-b-30">

                                                    <a href ="/Login/google" class="gl-s-api__btn gl-s-api__btn--gplus" type="button"><i class="fab fa-google"></i>

                                                        <span>Signup with Google</span></a></div>
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-fname">FIRST NAME *</label>
                                                   
                                                    <span  v-for="error in errors.first_name" :key="error.index" class="text-danger"> {{ error }}</span>
                                                    
                                                <input v-model="form.first_name" class="input-text input-text--primary-style" type="text" id="reg-fname" placeholder="First Name"></div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-lname">LAST NAME *</label>
                                                    <span  v-for="error in errors.last_name" :key="error.index" class="text-danger"> {{ error }}</span>
                                                <input v-model="form.last_name"  class="input-text input-text--primary-style" type="text" id="reg-lname" placeholder="Last Name"></div>

                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-email">E-MAIL *</label>
                                                         <span  v-for="error in errors.email" :key="error.index" class="text-danger"> {{ error }}</span>
                                                <input v-model="form.email"  class="input-text input-text--primary-style" type="text" id="reg-email" placeholder="Enter E-mail"></div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-password">PASSWORD *</label>
                                                         <span  v-for="error in errors.password" :key="error.index" class="text-danger"> {{ error }}</span>
                                                <input v-model="form.password"  class="input-text input-text--primary-style" type="password" id="reg-password" placeholder="Enter Password"></div>
                                                                                        <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-password1">CONFIRM PASSWORD *</label>

                                                <input v-model="form.password_confirmation"  class="input-text input-text--primary-style" type="password" id="reg-password1" placeholder="Confirm Password"></div>
                                            <div class="u-s-m-b-15">

                                                <button @click.prevent="Register()" class="btn btn--e-transparent-brand-b-2" type="submit">CREATE</button></div>

                                            <router-link :to="{name:'Home'}" class="gl-link" href="#">Return to Store</router-link>
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
import Auth from '../../../app/frontend/Store/Auth'
export default {
    data(){
        return{ 
            form:{
                first_name:'',
                last_name:'',
                email:'',
                password:'',
                password_confirmation:'',
            },
            errors:[],

        }
    },
    methods:{
            Register(){
                Auth.register(this.form).then(res => {
               this.$toasted.show(res.data.msg)
                this.$router.push({name:'Login'})
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
            },
            
    }
        

}
</script>