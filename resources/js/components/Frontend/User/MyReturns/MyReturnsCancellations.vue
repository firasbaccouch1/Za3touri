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

                                        <router-link :to="{name:'ReturnsCancellations'}">My Returns & Cancellations</router-link></li>
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

                                                    <router-link  :to='{name:"AddressBook"}' >Address Book</router-link></li>

                                                <li>

                                                    <router-link  :to='{name:"Orders"}' >My Orders</router-link></li>

                                                <li>

                                                    <router-link class="dash-active" :to='{name:"ReturnsCancellations"}' >My Returns &amp; Cancellations</router-link></li>
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
                           
                                <div v-if="Orders.length >0" class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">My Returns &amp; Cancellations</h1>

                                            <span class="dash__text u-s-m-b-30">Here you can see all ordres that you have been canceled.</span>
                                            <div class="m-order__list">
                                                <div v-for="order in Orders" :key="order.index" class="m-order__get">
                                                    <div class="manage-o__header u-s-m-b-30">
                                                        <div class="dash-l-r">
                                                            <div>
                                                                <div class="manage-o__text-2 u-c-secondary">Order #{{ order.order_number }}</div>
                                                                <div class="manage-o__text u-c-silver">Canceled AT {{ order.updated_at}}</div>
                                                            </div>
                                                            <div>
                                                                <div class="dash__link dash__link--brand">

                                                                    <router-link :to='{name:"Order",params:{ordernumber:order.order_number}}' >MANAGE</router-link></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="manage-o__description">
                                                        <div class="description__container">
                                                            <div class="description__img-wrap">

                                                                <img class="u-img-fluid" v-lazy="order.photo" alt=""></div>
                                                            
                                                        </div>
                                                        <div class="description__info-wrap">
                                                            <div><span class="manage-o__badge badge--delivered">Canceled</span></div>
                                                            <div>

                                                                <span class="manage-o__text-2 u-c-silver">Quantity:

                                                                    <span class="manage-o__text-2 u-c-secondary">{{ order.count }}</span></span></div>
                                                            <div>

                                                                <span class="manage-o__text-2 u-c-silver">Total:

                                                                    <span class="manage-o__text-2 u-c-secondary">${{ order.Total }}</span></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">My Returns &amp; Cancellations</h1>

                                            <span class="dash__text">There are no returns &amp; cancellations yet.</span>
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
            Orders:[],
        }
    },computed: { 
            ...mapGetters({
        user: 'user',
    }),
    },created(){
        Api.get('/CanceledOrders').then(res => {
            this.Orders = res.data.data;
        }).catch(err =>{
            this.Orders = []
        })
    }
}
</script>