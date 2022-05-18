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
                                        <router-link :to='{name:"AddressBook"}'>Address Book</router-link></li>
                                    <li class="is-marked">
                                        <a>Default Address Book</a></li>
                                        
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

                                                    <router-link :to='{name:"Profile"}' >My Profile</router-link></li>
                                                <li>

                                                    <router-link  class="dash-active" :to='{name:"AddressBook"}' >Address Book</router-link></li>

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
                                    <form class="dash__address-make">
                                        <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
                                            <h2 class="dash__h2 u-s-p-xy-20">Make default Shipping Address</h2>
                                            <div class="dash__table-2-wrap gl-scroll">
                                                <table class="dash__table-2">
                                                    <thead>
                                                        <tr>
                                                            <th>Action</th>
                                                            <th>Full Name</th>
                                                            <th>Address</th>
                                                            <th>Region</th>
                                                            <th>Phone Number</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(address,index) in Address" :key='address.index'>
                                                            <td>

                                                                <!--====== Radio Box ======-->
                                                                <div class="radio-box">

                                                                    <input @click='getaddressid(address.id)' type="radio" :id="'address-'+index" name="default-address" :checked='address.default == 1'>
                                                                    <div class="radio-box__state radio-box__state--primary">

                                                                        <label class="radio-box__label" :for="'address-'+index"></label></div>
                                                                </div>
                                                                <!--====== End - Radio Box ======-->
                                                            </td>
                                                        <td>{{ address.first_name }} {{ address.last_name }}</td>
                                                        <td>{{ address.street_address }}</td>
                                                        <td>{{ address.country.nicename }} - {{ address.state }}</td>
                                                        <td>(+{{ address.country.phonecode }}) {{ address.phone }}</td>
                                                        <td>
                                                            <div v-if="address.default == 1" class="gl-text">Default Shipping Address</div>
                                                            <div v-if="address.default == 1" class="gl-text">Default Billing Address</div>
                                                        </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div>

                                            <button @click.prevent="updateDefaultAddress()" class="btn btn--e-brand-b-2" type="submit">SAVE</button></div>
                                    </form>
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
import { mapGetters } from 'vuex';
import Api from '../../../../app/frontend/Api/Api';
export default {
    data(){
        return {
            Address:[],
            Address_id:null,
        }
    },computed:{ 
            ...mapGetters({
        user: 'user',
    }),
    },
    methods:{
        defaultAddress(){
                Api.get('/AddressBook').then(res => {
        this.Address = res.data.data;
    }).catch(err => {
        this.$toasted.show('Somthing Went Wrong Please Try Again Later',{
        type : 'error',
        icon : 'exclamation-triangle'
    }) 
        this.$router.push({ name: "Home"})
    })
    
    },getaddressid(id){
            this.Address_id = id
    },
    updateDefaultAddress(){
        if (this.Address_id == null) {
            this.$toasted.show('Default Address Updated Successfully')
        this.$router.push({ name: "AddressBook"})
        console.log('yes')
        }else{
        Api.get('/Make-Default/'+this.Address_id).then(res => {
            this.$toasted.show(res.data.msg)
             this.$router.push({ name: "AddressBook"})
        }).catch(err => {
             this.$toasted.show(err.response.data.msg,{
        type : 'error',
        icon : 'exclamation-triangle'
    })  
        });
        }

    }
    
    },created(){
        this.defaultAddress();
    }
}
</script>