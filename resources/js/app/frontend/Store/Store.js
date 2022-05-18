import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex)
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
const store = new Vuex.Store({

  namespaced: true,
  state:{
      authenticated:getCookie('checkauth')=='true'?true:false,
      user:{
        wishlist_count:0,
      },
      cart:{
        Cart_Data:[],
        Sub_Total:0,
        Total:0,
        count:0,
        Taxt:0,
        Shipping:0,

      },
  },
  getters:{
      authenticated(state){
          return state.authenticated
      },
      user(state){
          return state.user
      },
      cart(state){
        return state.cart
      },
  },
  mutations:{
      SET_AUTHENTICATED (state, value) {
          state.authenticated = value
      },
      SET_USER (state, value) {
          state.user = value
      },
      SET_WISHLIST_COUNT(state,operation) {
       if(operation === 'plus'){
          state.user.wishlist_count += 1
       }if(operation == 'minus'){
        state.user.wishlist_count -= 1
       }if(operation == null){
        state.user.wishlist_count = 0 
       }
      },
      SET_ORDER_COUNT (state,operation) {
        if(operation == 'plus'){
         state.user.order_count += 1
        }if(operation == 'minus'){
         state.user.order_count -=1
        }if(operation ==null){
         state.user.order_count = 0 
        }
       },
       SET_CANCEL_ORDERS_COUNT (state,operation) {
        if(operation == 'plus'){
         state.user.cancel_orders_count +=1
        }if(operation == 'minus'){
         state.user.cancel_orders_count -=1
        }if(operation == null){
         state.user.cancel_orders_count = 0 
        }
       },
      SET_CART (state, value) {
        state.cart = value
    }
  },actions:{
    SET_WISHLIST_COUNT({ commit }, operation) {
      commit('SET_WISHLIST_COUNT', operation);
    },
    SET_ORDER_COUNT({ commit }, operation) {
      commit('SET_ORDER_COUNT', operation);
    },
    SET_CANCEL_ORDERS_COUNT({ commit }, operation) {
      commit('SET_CANCEL_ORDERS_COUNT', operation);
    },
  }
  
})
export default store;
