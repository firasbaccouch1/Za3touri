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
                                        <router-link :to='{name:"Orders"}'>My Orders</router-link></li>
                                    <li class="is-marked">
                                        <a >Order Details</a></li>
                                        
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

                                                    <router-link class="dash-active" :to='{name:"Orders"}' >My Orders</router-link></li>

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
                                <div v-if="Order" class="col-lg-9 col-md-12">
                                    <h1 class="dash__h1 u-s-m-b-30">Order Details</h1>
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <div class="dash-l-r">
                                                <div>
                                                    <div class="manage-o__text-2 u-c-secondary">Order #{{ Order.order_number }}</div>
                                                    <div class="manage-o__text u-c-silver">Placed on {{ Order.created_at }}</div>
                                                </div>
                                                <div>
                                                    <div class="manage-o__text-2 u-c-silver">Total:

                                                        <span class="manage-o__text-2 u-c-secondary">${{ parseFloat(Order.data.purchases.Total).toFixed(0)}}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <div class="manage-o">
                                                <div class="manage-o__header u-s-m-b-30">
                                                    <div class="manage-o__icon"><i class="fas fa-box u-s-m-r-5"></i>

                                                        <span class="manage-o__text">Package </span></div>
                                                </div>
                                                <div v-for='item in Order.data.purchases.Cart_Data' :key='item.index' class="manage-o__description">
                                                    <div class="description__container">
                                                        <div class="description__img-wrap">

                                                            <img class="u-img-fluid" v-lazy="base_url+'/'+item.product.thumbnail" alt=""></div>
                                                        <div class="description-title">{{ item.product.name }}</div>
                                                    </div>
                                                    <div v-if="Order.status == 'delivered'" class="description__info-wrap">
                                                             <router-link :to='{name:"Product",params:{slug:item.product.slug}}' class="dash__link dash__link--secondary">Leave Review</router-link>
                                                    </div>
                                                    <div class="description__info-wrap">
                                                        <div>

                                                            <span class="manage-o__text-2 u-c-silver">Quantity:

                                                                <span class="manage-o__text-2 u-c-secondary">{{ item.quantity }}</span></span></div>
                                                        <div>
                                                    <span v-if="item.product.discount" class="manage-o__text-2 u-c-silver">Price: <span class="manage-o__text-2 u-c-secondary">${{ parseFloat( (item.product.price - (item.product.discount.discount*item.product.price)/100)).toFixed(0)}}</span>

                                                    <span class="w-r__discount">${{ item.product.price }}</span></span>
                                                    <span v-else class="manage-o__text-2 u-c-silver">Price: <span class="manage-o__text-2 u-c-secondary">${{ item.product.price }}</span>
                                                    <span class="w-r__discount"></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Shipping Address</h2>
                                                    <h2 class="dash__h2 u-s-m-b-8">{{ Order.data.shippingaddress.first_name }} {{ Order.data.shippingaddress.last_name }}</h2>

                                                    <span class="dash__text-2">{{ Order.data.shippingaddress.country.nicename }} - {{ Order.data.shippingaddress.state }} - {{ Order.data.shippingaddress.street_address }} </span>

                                                    <span class="dash__text-2">(+{{ Order.data.shippingaddress.country.phonecode }}) {{ Order.data.shippingaddress.phone }}</span>
                                                </div>
                                            </div>
                                            <div  class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Note</h2>
                                                    <h2 class="dash__h2 u-s-m-b-8"></h2>

                                                    <span class="dash__text-2">unpaid Order will be removed automatically in 3 days</span>
                                                        <hr>
                                                    <span class="dash__text-2">you can cancel paid order when they are steel in processing but when they are been delivered you can't cancel them anymore</span>
                                                </div>
                                            </div>

                                             </div>
                                        <div class="col-lg-6">
                                            <div class="dash__box dash__box--bg-white dash__box--shadow u-h-100">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Total Summary</h2>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Subtotal</div>
                                                        <div class="manage-o__text-2 u-c-secondary">${{ parseFloat(Order.data.purchases.Sub_Total).toFixed(0)}}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Shipping Fee</div>
                                                        <div class="manage-o__text-2 u-c-secondary">${{ Order.data.purchases.Shipping }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">TVA</div>
                                                        <div class="manage-o__text-2 u-c-secondary">%{{ Order.data.purchases.Tax }}</div>
                                                    </div>
                                                    <div v-if="Order.data.purchases.coupon != null" class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Coupon</div>
                                                        <div class="manage-o__text-2 u-c-secondary">-${{ Order.data.purchases.coupon }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Total</div>
                                                        <div class="manage-o__text-2 u-c-secondary">${{ parseFloat(Order.data.purchases.Total).toFixed(0)}}</div>
                                                    </div>
                                                    <br><hr>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Status</div>
                                                        <div class="manage-o__text-2 u-c-secondary">
                                                            <div v-if="Order.status == 'cancel'"><span class="manage-o__badge badge--unpaid">Canceled</span></div>
                                                            <div v-if="Order.status == 'unpaid'"><span class="manage-o__badge badge--unpaid">Unpaid</span></div>
                                                            <div v-if="Order.status == 'paid'"><span class="manage-o__badge badge--processing">Processing</span></div>
                                                            <div v-if="Order.status == 'shipped'"><span class="manage-o__badge badge--shipped">Shipped</span></div>
                                                            <div v-if="Order.status == 'delivered'"><span class="manage-o__badge badge--delivered">Delivered</span></div>
                                                        </div>
                                                    </div>
                                                    <div v-if="Order.status != 'delivered'">
                                                        <div v-if="Order.payment != null" class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary"><span class="dash__text-2">Paid by:</span></div>
                                                        <div class="manage-o__text-2 u-c-secondary"> <span class="manage-o__text-2 u-c-secondary">{{ Order.payment.payment_gateway }}</span> </div>
                                                        </div>
                                                        <div v-else class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary"><a class="l-f-o__create-link btn--e-transparent-brand-b-2" :href="Order.payment_url">Pay Now</a></div>
                                                        </div>
                                                        <div v-if="Order.payment != null" class="dash-l-r u-s-m-b-8">
                                                        <div v-if="Order.status == 'paid'" class="manage-o__text-2 u-c-secondary"><a class="l-f-o__create-link btn--e-transparent-brand-b-2" @click.prevent="CancelOrder(Order.order_number)">Cancel Order</a></div>
                                                         <div v-if="Order.status == 'cancel'" class="manage-o__text-2 u-c-secondary"><a class="l-f-o__create-link btn--e-transparent-brand-b-2" @click.prevent="uncancelOrder(Order.order_number)">Uncancel Order</a></div>
                                                        </div>
                                                    </div>
                        
                                                    
                                               
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
</template>
<script>
import Api from '../../../../app/frontend/Api/Api'
import { mapGetters } from 'vuex';
export default {
    data(){
        return {
            Order:null,
            base_url: window.location.origin 
        }
    },created(){
      var ordernumber = this.$route.params.ordernumber
        Api.get('/getOrder/'+ordernumber).then(res => {
            this.Order = res.data.data

        }).catch(err => {
        this.$toasted.show(err.response.data.msg,{
        type : 'error',
        icon : 'exclamation-triangle'
    }) 

        })
    },computed: { 
            ...mapGetters({
        user: 'user',
    }),

    },methods:{
        CancelOrder(order_number){
            Api.get('CancelOrder/'+order_number).then(res => {
                 this.$toasted.show(res.data.msg)
                 this.$store.dispatch('SET_ORDER_COUNT','minus')
                 this.$store.dispatch('SET_CANCEL_ORDERS_COUNT','plus')
                 this.$router.push({ name: "Orders"})
            }).catch(err => {
                this.$toasted.show(err.response.data.msg,{
                type : 'error',
                icon : 'exclamation-triangle'
            }) 
                 this.$router.push({ name: "Orders"})
            })
        },uncancelOrder(order_number){
            Api.get('unCancelOrder/'+order_number).then(res => {
                 this.$toasted.show(res.data.msg)
                 this.$store.dispatch('SET_ORDER_COUNT','plus')
                 this.$store.dispatch('SET_CANCEL_ORDERS_COUNT','minus')
                 this.$router.push({ name: "Orders"})
            }).catch(err => {
                this.$toasted.show(err.response.data.msg,{
                type : 'error',
                icon : 'exclamation-triangle'
            }) 
                 this.$router.push({ name: "Orders"})
            })

        }
    }
}
</script>
<style scoped>

</style>