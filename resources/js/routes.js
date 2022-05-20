
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './app/frontend/Store/Store'
Vue.use(VueRouter)
//login
let Login = require('./components/Frontend/Auth/Login.vue').default;
let Register = require('./components/Frontend/Auth/Register.vue').default;
let ForgetPassword = require('./components/Frontend/Auth/Forget_Password.vue').default;
//home
let Home = require('./components/Frontend/Home.vue').default;
//not found
let PageNotFound = require('./components/Frontend/NotFound404/PageNotFound.vue').default;
// products
let FilterProduct = require('./components/Frontend/Pages/FilterProduct.vue').default;
let Wishlist = require('./components/Frontend/Pages/Wishlist.vue').default;
let Category = require('./components/Frontend/Pages/Category.vue').default;
let Product = require('./components/Frontend/Pages/Product.vue').default;
let Cart = require('./components/Frontend/Pages/Cart.vue').default;
let Checkout = require('./components/Frontend/Pages/Checkout.vue').default;
let Search = require('./components/Frontend/Pages/Search.vue').default;
// contact
let AboutUs = require('./components/Frontend/Pages/AboutUs.vue').default;
let Feedback = require('./components/Frontend/Pages/Feedback.vue').default;
let Contact = require('./components/Frontend/Pages/Contact.vue').default;
//profile
let ChangePassword = require('./components/Frontend/User/Profile/ChangePassword.vue').default;
let EditProfile = require('./components/Frontend/User/Profile/EditProfile.vue').default;
let MyProfile = require('./components/Frontend/User/Profile/MyProfile.vue').default;
let ResetEmail = require('./components/Frontend/User/Profile/ResetEmail.vue').default;
let ChangeEmail = require('./components/Frontend/User/Profile/ChangeEmail.vue').default;
// AddressBook
let EditAddress= require('./components/Frontend/User/AdressBook/EditAdress.vue').default;
let DefaultAddress = require('./components/Frontend/User/AdressBook/DefaultAddress.vue').default;
let AddressBook = require('./components/Frontend/User/AdressBook/Address.vue').default;
let CreateAddressBook = require('./components/Frontend/User/AdressBook/CreateAddress.vue').default;
//ManageMyAccount
let ManageMyAccount = require('./components/Frontend/User/ManageMyAccount/ManageMyAccount.vue').default;

// My Oreders
let MyOrders = require('./components/Frontend/User/Orders/MyOrders.vue').default;
let Order = require('./components/Frontend/User/Orders/Order.vue').default;

// ReturnsCancellations
let ReturnsCancellations = require('./components/Frontend/User/MyReturns/MyReturnsCancellations.vue').default;








 





 const routes=  [
    //Home
    { path: '/',component:Home ,name:'Home', meta:{title:`Home`}},
    //banned page
    
   
    //auth
    { path: '/Login',component:Login,name:'Login', meta:{title:`Login`}},
    { path: '/Register',component:Register,name:'Register',meta:{title:`Register`}},
    { path: '/Forget_Password',component:ForgetPassword,name:'ForgetPassword',meta:{title:`ForgetPassword`}},
    //profile 
    { path: '/Edit-Profile',component:EditProfile,name:'EditProfile', meta:{title:`Edit Profile`,middleware:'auth'}},
    { path: '/Reset-Email',component:ResetEmail,name:'ResetEmail', meta:{title:`Reset Email`,middleware:'auth'}},
    { path: '/Change-Email/:token',component:ChangeEmail,name:'ChangeEmail', meta:{title:`Change Email`}},
    { path: '/Change-Password',component:ChangePassword,name:'ChangePassword', meta:{title:`Change Password`,middleware:'auth'}},
    { path: '/Profile',component:MyProfile,name:'Profile', meta:{title:`Profile`,middleware:'auth'}},
    { path: '/Wishlist',component:Wishlist,name:'Wishlist', meta:{title:`Wishlist`,middleware:'auth'}},
    { path: '/Manage-My-Account',component:ManageMyAccount,name:'ManageMyAccount', meta:{title:`Manage My Account`,middleware:'auth'}},
    //address
    { path: '/Address-Book',component:AddressBook,name:'AddressBook', meta:{title:`Address Book`,middleware:'auth'}},
    { path: '/EditAddress/:id',component:EditAddress,name:'EditAddress',props: true, meta:{title:`Edit Address`,middleware:'auth'}},
    { path: '/Default-Address',component:DefaultAddress,name:'DefaultAddress',props: true, meta:{title:`Default Address`,middleware:'auth'}},
    { path: '/Create-Address-Book',component:CreateAddressBook,name:'CreateAddressBook', meta:{title:`Create Address Book`,middleware:'auth'}},
    //order
    { path: '/Order/:ordernumber',component:Order,name:'Order', meta:{title:`Order`,middleware:'auth'}},
    { path: '/Orders',component:MyOrders,name:'Orders', meta:{title:`Orders`,middleware:'auth'}},

    //returns
    { path: '/Returns-Cancellations',component:ReturnsCancellations,name:'ReturnsCancellations', meta:{title:`Returns & Cancellations`,middleware:'auth'}},
    // product
    { path: '/Product/:slug',component:Product,name:'Product', meta:{title:`Product`}},
    { path: '/Fiter_Products',component:FilterProduct,name:'FilterProduct', meta:{title:`FilterProduct`}},
    //about us
    { path: '/About',component:AboutUs,name:'AboutUs', meta:{title:`About us`}},
    { path: '/Feedback',component:Feedback,name:'Feedback', meta:{title:`Feedback`}},
    { path: '/Contact',component:Contact,name:'Contact', meta:{title:`Contact`}},
    //category
    { path: '/category/:slug',component:Category,name:'Category',props:true, meta:{title:`Category`}},
    //cart
    { path: '/Cart',component:Cart,name:'Cart',meta:{title:`Cart`,middleware:'auth'}},
    //checkout
    { path: '/Checkout',component:Checkout,name:'Checkout', meta:{title:`Checkout`,middleware:'auth'}},
    //search
    { path: '/Search/:name',component:Search,name:'Search',props:true, meta:{title:`Search`}},
    // 404
    { path: '*',component:PageNotFound ,name:'PageNotFound', meta:{title:`PageNotFound`}},

]

 
var router  = new VueRouter({
    mode: 'history',
    routes
}) 


router.beforeEach((to, from, next) => {
    document.title = `Za3touri - ${to.meta.title}`
    if(to.meta.middleware=="auth"){
        if(store.state.authenticated){
            next()
        }else{
            next({name:"Login"})
        }
     
    }
    next()
})
export default router

 