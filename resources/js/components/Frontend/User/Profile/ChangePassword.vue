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
                                    <li class="has-separator">
                                        <router-link :to='{name:"Profile"}'>My Profile</router-link></li>
                                    <li class="is-marked">
                                        <a>Change Password</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="dash">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">

                                    <!--====== Dashboard Features ======-->
                                    <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                        <div class="dash__pad-1">

                                            <span class="dash__text u-s-m-b-16">Hello, {{ user.first_name}} {{ user.last_name }}</span>
                                            <ul class="dash__f-list">
                                                <li>

                                                    <router-link :to='{name:"ManageMyAccount"}' >Manage My Account</router-link></li>
                                                <li>

                                                    <router-link class="dash-active" :to='{name:"Profile"}' >My Profile</router-link></li>
                                                <li>

                                                    <router-link :to='{name:"AddressBook"}' >Address Book</router-link></li>

                                                <li>

                                                    <router-link :to='{name:"Orders"}' >My Orders</router-link></li>
  
                                                <li>

                                                    <router-link :to='{name:"ReturnsCancellations"}' >My Returns &amp; Cancellations</router-link></li>
                                            </ul>
                                        </div>
                                    </div>
                                     <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w">
                                        <div class="dash__pad-1">
                                            <ul class="dash__w-list">
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-cart-arrow-down"></i></span>

                                                        <span class="dash__w-text">{{ user.order_count }}</span>

                                                        <span class="dash__w-name">Orders Placed</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-2"><i class="fas fa-times"></i></span>

                                                        <span class="dash__w-text">{{ user.cancel_orders_count }}</span>

                                                        <span class="dash__w-name">Cancel Orders</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-3"><i class="far fa-heart"></i></span>

                                                        <span class="dash__w-text">{{ user.wishlist_count }}</span>

                                                        <span class="dash__w-name">Wishlist</span></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                               <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Edit Password</h1>

                                            <span class="dash__text u-s-m-b-30">Looks like you haven't update your password</span>
                                             <ul class="dash__f-list">
                                                <li v-for="error in errors.password" :key='error.index'>
                                                    <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                                <li v-for="error in errors.currant_password" :key='error.index'>
                                                    <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                            </ul>
                                            <div class="dash__link dash__link--secondary u-s-m-b-30">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="dash-edit-p">
                                                        <div v-if="haspassword" class="gl-inline">
                                                            <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="currantpassword">CURRENT PASSWORD*</label>

                                                                <input v-model="form.currant_password" class="input-text input-text--primary-style" type="text" id="currantpassword"></div>
                                                        </div>
                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="password">NEW PASSWORD *</label>

                                                                <input v-model="form.password" class="input-text input-text--primary-style" type="text" id="password"></div>
                                                        </div>
                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="password_confirmation">CONFIRM PASSWORD *</label>

                                                                <input v-model="form.password_confirmation" class="input-text input-text--primary-style" type="text" id="password_confirmation"></div>
                                                        </div>
                                                        
                                                        

                                                        <button @click.prevent="ChangePassword()" class="btn btn--e-brand-b-2" type="submit">SAVE</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
import Api from '../../../../app/frontend/Api/Api';
import { mapGetters } from 'vuex';
export default {
    data(){
        return {
            form:{
                currant_password:'',
                password:'',
                password_confirmation:'',
               
            },
             haspassword:true,
            errors:[],
        }
    },computed: { 
            ...mapGetters({
        user: 'user',
    }),
    },methods:{
        ChangePassword(){
        Api.patch('Change-Password',this.form).then(res => {
            this.$toasted.show(res.data.msg)
             this.$router.push({name: "Profile"})
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
        Api.get('/Change-Password-Component').then(res =>{
            this.haspassword = res.data.data;
        })
    }
}
</script>
<style scoped>
.text-danger{
    color: red;
    
}
</style>