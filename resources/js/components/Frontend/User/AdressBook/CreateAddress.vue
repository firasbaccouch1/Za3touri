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

                                        <router-link :to="{name:'AddressBook'}">My Address Book</router-link></li>
                                    <li class="is-marked">

                                        <a >Create Address Book</a></li>
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
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Add new Address</h1>

                                            <span class="dash__text u-s-m-b-30">We need an address where we could deliver products.</span>
                                            <ul class="dash__f-list">
                                                <li v-for="error in errors.city" :key='error.index'>
                                                    <span  class="text-danger" >- {{ error }}</span>
                                                </li>
                                                <li v-for="error in errors.country_id" :key='error.index'>
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
                                                <li v-for="error in errors.state" :key='error.index'>
                                                    <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                                 <li v-for="error in errors.street_address" :key='error.index'>
                                                    <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                                 <li v-for="error in errors.zip_code" :key='error.index'>
                                                    <span class="text-danger" >- {{ error }}</span>
                                                </li>
                                            </ul>
                                        
                                            <form class="dash-address-manipulation">
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-fname">FIRST NAME *</label>

                                                        <input v-model="form.first_name"  class="input-text input-text--primary-style" type="text" id="address-fname" placeholder="First Name"></div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-lname">LAST NAME *</label>

                                                        <input v-model="form.last_name" class="input-text input-text--primary-style" type="text" id="address-lname" placeholder="Last Name"></div>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-phone">PHONE *</label>

                                                        <input v-model="form.phone" class="input-text input-text--primary-style" type="text" id="address-phone"></div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-street">STREET ADDRESS *</label>

                                                        <input  v-model="form.street_address" class="input-text input-text--primary-style" type="text" id="address-street" placeholder="House Name and Street"></div>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <!--====== Select Box ======-->

                                                        <label class="gl-label" for="address-country">COUNTRY *</label>
                                                        <select @change="changecountry($event)"  class="select-box select-box--primary-style" id="address-country">
                                                            <option disabled='true' selected="" value="">Choose Country</option>
                                                            <option v-for="countries in Countries" :key='countries.index' :value="countries.id">{{ countries.nicename }} ({{ countries.iso }})</option>
                                                        </select>
                                                        <!--====== End - Select Box ======-->
                                                    </div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-street">STATE/PROVINCE *</label>

                                                        <input v-model="form.state" class="input-text input-text--primary-style" type="text" id="address-state"></div>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-city">TOWN/CITY *</label>
                                                              
                                                        <input v-model="form.city" class="input-text input-text--primary-style" type="text" id="address-city"></div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-street">ZIP/POSTAL CODE *</label>

                                                        <input v-model="form.zip_code" class="input-text input-text--primary-style" type="text" id="address-postal" placeholder="Zip/Postal Code"></div>
                                                </div>

                                                <button @click.prevent='createaddress()' class="btn btn--e-brand-b-2" type="submit">SAVE</button>
                                            </form>
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
import { mapGetters } from 'vuex';
import Api from '../../../../app/frontend/Api/Api';
export default {
    data(){
        return {
            Countries:[],
            form:{
                first_name:'',
                last_name:'',
                phone:'',
                street_address:'',
                country_id:'',
                state:'',
                city:'',
                zip_code:'',
            },
            errors:[],
        }
    },computed:{ 
            ...mapGetters({
        user: 'user',
    }),
    },methods:{
        createaddress(){
        Api.post('/AddressBook',this.form).then(res => {
            this.$toasted.show(res.data.msg)
            this.$router.push({ name: "AddressBook"})

        }).catch(err => {
            this.errors = err.response.data.errors
        })
        },
        changecountry(event){
           this.form.country_id = event.target.value;
        }

    },created(){
      Api.get('/getCountries').then(res=>{
     this.Countries = res.data.data.countries;
        }).catch(err => {
        this.$toasted.show('Somthing Went Wrong Please Try Again Later',{
        type : 'error',
        icon : 'exclamation-triangle'
    }) 
        this.$router.push({ name: "Home"})
    })
      this.form.first_name = this.user.first_name
      this.form.last_name =this.user.last_name
    }
}
</script>
<style scoped>
.text-danger{
    color: red;
    
}
</style>
