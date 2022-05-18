<template>
    <div>
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

                                            <router-link :to="{ name:'Home'}">Home</router-link> </li>
                                    <li class="is-marked">

                                    <router-link :to="{ name:'Login'}">Signin</router-link> </li>
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
                                    <h1 class="section__heading u-c-secondary">ALREADY REGISTERED?</h1>
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
                                        <h1 class="gl-h1">I'M NEW CUSTOMER</h1>

                                        <span class="gl-text u-s-m-b-30">By creating an account with our store, you will be able to move through the checkout process faster, store shipping addresses, view and track your orders in your account and more.</span>
                                        <div class="u-s-m-b-15">

                                            <router-link :to="{name:'Register'}" class="l-f-o__create-link btn--e-transparent-brand-b-2" href="signup.html">CREATE AN ACCOUNT</router-link></div>
                                        <h1 class="gl-h1">SIGNIN</h1>

                                        <span class="gl-text u-s-m-b-30">If you have an account with us, please log in.</span>
                                        <form  class="l-f-o__form">
                                            <div class="gl-s-api">
                                                <div class="u-s-m-b-15">

                                                    <a  href ="/Login/facebook" class="gl-s-api__btn gl-s-api__btn--fb" type="button"><i class="fab fa-facebook-f"></i>

                                                        <span>Signin with Facebook</span></a></div>
                                                <div class="u-s-m-b-15">

                                                    <a  href ="/Login/google" class="gl-s-api__btn gl-s-api__btn--gplus" type="button"><i class="fab fa-google"></i>

                                                        <span>Signin with Google</span></a></div>
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="login-email">E-MAIL *</label>

                                                <input v-model="form.email" class="input-text input-text--primary-style" type="text" id="login-email" placeholder="Enter E-mail"></div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="login-password">PASSWORD *</label>

                                                <input v-model="form.password" class="input-text input-text--primary-style" type="password" id="login-password" placeholder="Enter Password"></div>
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-30">

                                                    <button @click.prevent="Login()" class="btn btn--e-transparent-brand-b-2" type="submit">LOGIN</button></div>
                                                <div class="u-s-m-b-30">

                                                    <router-link class="gl-link" :to="{name:'ForgetPassword'}">Lost Your Password?</router-link></div>
                                            </div>

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
    </div>
</template>
<script>
import Auth from '../../../app/frontend/Store/Auth'
    export default {
        data(){
            return {
                form:{
                    email:'',
                    password:'',
                },
            }
        },methods:{
            Login(){
                Auth.login(this.form).then(res =>{
                    this.$store.commit('SET_AUTHENTICATED',true)
                    this.$store.commit('SET_USER',res.data.data)
                    this.$router.push({ name: "Home"})
                    this.$toasted.show(res.data.msg)
                }).catch(error =>{
                this.$toasted.show(error.response.data.msg,{
                     type : 'error',
                    icon : 'exclamation-triangle'
               }) 
                })
            }
        },created(){
            if (this.$cookies.get('checkauth') =='true' || this.$store.state.authenticated == true) {
            this.$router.push({ name: "Home"})
            }
        }
    }
</script>

<style>

</style>
