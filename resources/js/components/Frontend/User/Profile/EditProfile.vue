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
                                        <a>Edit Profile</a></li>
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
                                            <h1 class="dash__h1 u-s-m-b-14">Edit Profile</h1>

                                            <span class="dash__text u-s-m-b-30">Looks like you haven't update your profile</span>
                                             <ul class="dash__f-list">
                                                <li v-for="error in errors.birthday" :key='error.index'>
                                                    <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                                <li v-for="error in errors.first_name" :key='error.index'>
                                                   <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                                <li v-for="error in errors.last_name" :key='error.index'>
                                                    <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                                <li v-for="error in errors.phone" :key='error.index'>
                                                    <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                            </ul>
                                            <div class="dash__link dash__link--secondary u-s-m-b-30">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="dash-edit-p">
                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="reg-fname">FIRST NAME *</label>

                                                                <input v-model="form.first_name" class="input-text input-text--primary-style" type="text" id="reg-fname" ></div>
                                                            <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="reg-lname">LAST NAME *</label>

                                                                <input  v-model="form.last_name" class="input-text input-text--primary-style" type="text" id="reg-lname">
                                                                </div>
                                                        </div>
                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-30">

                                                                <!--====== Date of Birth Select-Box ======-->

                                                                <span class="gl-label">BIRTHDAY</span>
                                                                <div class="gl-dob"><input v-model="form.birthday" class="select-box select-box--primary-style u-w-100" type="date"></div>
                                                                <!--====== End - Date of Birth Select-Box ======-->
                                                            </div>
                                                              <div class="u-s-m-b-30">

                                                                <label class="gl-label" for="reg-lphone">Phone *</label>
                                                                <input  v-model="form.phone" class="input-text input-text--primary-style" type="text" id="reg-lphone">
                                                        </div>
                                                        </div>
                                                        <div class="gl-inline">
                                                            <div class="u-s-m-b-30">
                                                                <h2 class="dash__h2 u-s-m-b-8">E-mail</h2>

                                                                <span class="dash__text">{{ user.email }}</span>
                                                                <div class="dash__link dash__link--secondary">

                                                                    <router-link :to='{name:"ResetEmail"}' >Change</router-link></div>
                                                            </div>
                                                       
                                                        <div class="u-s-m-b-30">

                                                        </div>
                                                        </div>

                                                        <button @click.prevent="UpdateProfile()" class="btn btn--e-brand-b-2" type="submit">SAVE</button>
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
                first_name:'',
                last_name:'',
                phone:'',
                birthday:'',
            },
            errors:[],
        }
    },computed: { 
            ...mapGetters({
        user: 'user',
    }),
    },methods:{
        UpdateProfile(){
        Api.patch('/Profile-Edit',this.form).then(res => {
            this.$toasted.show(res.data.msg)
            this.$store.commit('SET_USER',res.data.data)
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
        },EditProfile(){
            Api.get('/user').then(res=> {
        this.form.first_name = res.data.data.first_name
        this.form.last_name = res.data.data.last_name
        res.data.data.phone != undefined?this.form.phone = res.data.data.phone:this.form.phone='';
        res.data.data.birthday != undefined?this.form.birthday = res.data.data.birthday:this.form.birthday='';
            this.$store.commit('SET_USER',res.data.data);
             })
        }
    },created(){
        this.EditProfile();
    }
}
</script>
<style scoped>
.text-danger{
    color: red;
    
}
</style>