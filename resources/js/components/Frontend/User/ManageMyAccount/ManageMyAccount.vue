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

                                        <router-link :to="{name:'ManageMyAccount'}">My Account</router-link></li>
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

                                                    <router-link class="dash-active" :to='{name:"ManageMyAccount"}' >Manage My Account</router-link></li>
                                                <li>

                                                    <router-link :to='{name:"Profile"}' >My Profile</router-link></li>
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
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Manage My Account</h1>

                                            <span class="dash__text u-s-m-b-30">From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</span>
                                            <div class="row">
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                        <div class="dash__pad-3">
                                                            <h2 class="dash__h2 u-s-m-b-8">PERSONAL PROFILE</h2>
                                                            <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                                <router-link :to='{name:"Profile"}'>Edit</router-link></div>

                                                            <span v-if="users != null" class="dash__text">{{ users.name }}</span>

                                                            <span v-if="users != null" class="dash__text">{{ users.email }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="address != null" class="col-lg-4 u-s-m-b-30">
                                                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                        <div class="dash__pad-3">
                                                            <h2 class="dash__h2 u-s-m-b-8">ADDRESS BOOK</h2>

                                                            <span class="dash__text-2 u-s-m-b-8">Default Shipping Address</span>
                                                            <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                                <router-link :to='{name:"AddressBook"}'>Edit</router-link></div>

                                                            <span class="dash__text">{{ address.defulataddress }}</span>

                                                            <span class="dash__text">{{ address.phone }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else class="col-lg-4 u-s-m-b-30">
                                                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                        <div class="dash__pad-3">
                                                            <h2 class="dash__h2 u-s-m-b-8">ADDRESS BOOK</h2>

                                                            <span class="dash__text-2 u-s-m-b-8">Default Shipping Address</span>
                                                            <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                                <router-link :to='{name:"AddressBook"}'>Add AddressBook</router-link></div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="address != null" class="col-lg-4 u-s-m-b-30">
                                                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                        <div class="dash__pad-3">
                                                            <h2 class="dash__h2 u-s-m-b-8">BILLING ADDRESS</h2>

                                                            <span class="dash__text-2 u-s-m-b-8">Default Billing Address</span>
                                                            <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                                <router-link :to='{name:"AddressBook"}'>Edit</router-link></div>

                                                            <span class="dash__text">{{ address.defulataddress }}</span>

                                                            <span class="dash__text">{{ address.phone }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               <div v-else class="col-lg-4 u-s-m-b-30">
                                                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                        <div class="dash__pad-3">
                                                            <h2 class="dash__h2 u-s-m-b-8">BILLING ADDRESS</h2>

                                                            <span class="dash__text-2 u-s-m-b-8">Default Billing Address</span>
                                                            <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                                <router-link :to='{name:"AddressBook"}'>Add AddressBook</router-link></div>

                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius">
                                        <h2 class="dash__h2 u-s-p-xy-20">RECENT ORDERS</h2>
                                        <div class="dash__table-wrap gl-scroll">
                                            <table class="dash__table">
                                                <thead>
                                                    <tr>
                                                        <th>Order #</th>
                                                        <th>Placed On</th>
                                                        <th>status</th>
                                                        <th>Packege</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="order in orders" :key='order.index'>
                                                        <td>{{ order.order_number }}</td>
                                                        <td>{{ order.created_at }}</td>
                                                        <td>
                                                            <div v-if="order.status == 'unpaid'"><span class="manage-o__badge badge--unpaid">Unpaid</span></div>
                                                            <div v-if="order.status == 'paid'"><span class="manage-o__badge badge--processing">Processing</span></div>
                                                            <div v-if="order.status == 'shipped'"><span class="manage-o__badge badge--shipped">Shipped</span></div>
                                                            <div v-if="order.status == 'delivered'"><span class="manage-o__badge badge--delivered">Delivered</span></div>
                                                        </td>
                                                        <td>
                                                            <div class="dash__table-img-wrap">

                                                                <img class="u-img-fluid" v-lazy="order.photo" alt=""></div>
                                                        </td>
                                                        <td>
                                                            <div class="dash__table-total">

                                                                <span>${{ parseFloat(order.Total).toFixed(0)}}</span>
                                                                <div class="dash__link dash__link--brand">
                                                                <router-link :to='{name:"Order",params:{ordernumber:order.order_number}}' >MANAGE</router-link>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
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
</template>
<script>
import Api from '../../../../app/frontend/Api/Api'
import { mapGetters } from 'vuex';
export default {
    data(){
        return {
            orders:[],
            address:null,
            users:null,


        }
    },computed: { 
            ...mapGetters({
        user: 'user',
    }),
    },created(){
    Api.get('/Manage-My-Account-Component').then(res => {
        this.orders = res.data.data.orders
        this.address = res.data.data.address
        this.users = res.data.data.user
    }).catch(err => {
         this.$toasted.show(err.response.data.msg,{     
         type : 'success',
        icon : 'cart-arrow-down'
             }) 
        this.$router.push({name: "Home"})
    })
    }
}
</script>