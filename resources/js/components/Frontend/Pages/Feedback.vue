<template>
        <div class="app-content">
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

                                        <a >Feedback</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                <div class="u-s-p-b-60">
                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-area u-h-100">
                                    <div class="contact-area__heading">
                                        <h2>Leave Feedback</h2>
                                    </div>
                                    <form class="contact-f" method="post" >
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 u-h-100">
                                                <div class="u-s-m-b-30">
                                                            <li v-for="error in errors" :key='error.index'>
                                                                <span  class="text-danger" >- {{ error[0] }}</span>
                                                            </li>
                                                    <label for="c-message">YOUR FEEDBACK *(Max 400 / {{totalRemainCount}})</label>
                                                    <textarea v-model="form.message" @keydown="liveCountDown()"  class="text-area text-area--border-radius text-area--primary-style" id="c-message" placeholder="Compose a Message (Required)" required=""></textarea></div>
                                            </div>
                                            <div class="col-lg-12">

                                                <button @click.prevent="sendfeedback()" class="btn btn--e-brand-b-2" type="submit">Send Message</button></div>
                                        </div>
                                    </form>
                                </div>
                                <br><br>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            </div>
</template>
<script>
import carousel from 'vue-owl-carousel'
import Api from '../../../app/frontend/Api/Api'
export default {
    components: { carousel },
    data(){
        return {
            form:{
                message:'',
            },
            errors:[],
            limitmaxCount:400,
            totalRemainCount:400,
            Feedback:[],
        }
    },methods:{
        sendfeedback(){
            if(this.$store.state.authenticated == true){
            Api.post('/Feedback',this.form).then(res => {
            this.$toasted.show(res.data.msg)
            this.$router.push({ name: "Home"})
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
            }else{
                 this.$toasted.show('You Need To Login First',{
                    type : 'warning',
                    icon : 'smile-beam'
               }) 
            }
        },
        liveCountDown(){
         this.totalRemainCount = this.limitmaxCount - this.form.message.length;
        }
    },
}
</script>
<style scoped>

.text-danger{
    color: red;  
}
</style>