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

                                        <router-link :to='{name:"Home"}'>Home</router-link></li>
                                    <li class="is-marked">

                                        <a >Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->

            <!--====== Section 3 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="contact-o u-h-100">
                                    <div class="contact-o__wrap">
                                        <div class="contact-o__icon"><i class="fas fa-phone-volume"></i></div>

                                        <span class="contact-o__info-text-1">LET'S HAVE A CALL</span>

                                        <span class="contact-o__info-text-2">(+0) 000 000 000</span>

                                        <span class="contact-o__info-text-2">(+0) 000 000 000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="contact-o u-h-100">
                                    <div class="contact-o__wrap">
                                        <div class="contact-o__icon"><i class="fas fa-map-marker-alt"></i></div>

                                        <span class="contact-o__info-text-1">OUR LOCATION</span>

                                        <span class="contact-o__info-text-2">4247 Ashford Drive VA-20006</span>

                                        <span class="contact-o__info-text-2">Virginia US</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="contact-o u-h-100">
                                    <div class="contact-o__wrap">
                                        <div class="contact-o__icon"><i class="far fa-clock"></i></div>

                                        <span class="contact-o__info-text-1">WORK TIME</span>

                                        <span class="contact-o__info-text-2">5 Days a Week</span>

                                        <span class="contact-o__info-text-2">From 9 AM to 7 PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 3 ======-->


            <!--====== Section 4 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-area u-h-100">
                                    <div class="contact-area__heading">
                                        <h2>Get In Touch</h2>
                                         <li v-for="error in errors" :key='error.index'>
                                            <span  class="text-danger" >- {{ error[0] }}</span>
                                        </li>
                                    </div>
                                    <form class="contact-f" method="post" action="index.html">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 u-h-100">
                                                <div class="u-s-m-b-30">

                                                    <label for="c-name"></label>

                                                    <input v-model="form.name" class="input-text input-text--border-radius input-text--primary-style" type="text" id="c-name" placeholder="Name (Required)" required=""></div>
                                                <div class="u-s-m-b-30">

                                                    <label for="c-email"></label>

                                                    <input v-model="form.email" class="input-text input-text--border-radius input-text--primary-style" type="text" id="c-email" placeholder="Email (Required)" required=""></div>
                                                <div class="u-s-m-b-30">

                                                    <label for="c-subject"></label>

                                                    <input v-model="form.subject" class="input-text input-text--border-radius input-text--primary-style" type="text" id="c-subject" placeholder="Subject (Required)" required=""></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 u-h-100">
                                                <div class="u-s-m-b-30">

                                                    <label  for="c-message">YOUR MESSAGE *(Max 400 / {{totalRemainCount}})</label>
                                                    <textarea v-model="form.message"  @keydown="liveCountDown()"  class="text-area text-area--border-radius text-area--primary-style" id="c-message" placeholder="Compose a Message (Required)" required="" ></textarea></div>
                                            </div>
                                            <div class="col-lg-12">

                                                <button @click.prevent='GetInTouch()' class="btn btn--e-brand-b-2" type="submit">Send Message</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 4 ======-->
        </div>
</template>
<script>
import Api from '../../../app/frontend/Api/Api'
export default {
    data(){
        return{
            form:{
                name:"",
                email:"",
                subject:"",
                message:"",
            },
            errors:[],
            limitmaxCount:400,
            totalRemainCount:400,
        }
    },
    methods:{
        GetInTouch(){
            Api.post('/Message',this.form).then(res=>{
                this.$toasted.show(res.data.msg)
                 this.$router.push({name: "Home"})
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
            
        },liveCountDown(){
         this.totalRemainCount = this.limitmaxCount - this.form.message.length;
        }
    }
}
</script>
<style scoped>

.text-danger{
    color: red;  
}
</style>