<template>
    <div class="container">
       <!-- Nav Item - Alerts -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-lg" style="color:#545871; !important"></i>
          <!-- Counter - Alerts -->
          <span :class="Notifications.length>0?'badge badge-danger badge-counter':'badge badge-success badge-counter'"><b id="animation" >{{ Notifications.length }}</b></span>
        </a>
        <!-- Dropdown - Alerts -->
   
        <div  v-if="Notifications.length>0" class=" dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in text-center " aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            Notifications
              <div>
           
        </div>
          </h6>
          <a  @click='readNotification()' id='readall' class="badge badge-secondary text-center"><b>Read All</b></a>
            
            <div class="divScroll" >
            <div  v-for="Notification  in Notifications" :key="Notification.length">
                 
          <a  class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="bg-warning">
               <img class="icon-circle" :src="location+'/'+Notification.photo" alt="">
              </div>
            </div>
            <div>
              <div class="small text-gray-500">{{ Notification.created_at| formatDate }}</div>
                  <span>  {{ Notification.title }}<b class="badge badge-warning" >{{ Notification.user }}</b> </span>
            </div>
            <hr>
           
          </a>
           
          </div>
          </div>
        </div>
         <div v-else class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in text-center" aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            Notifications
          </h6>
          <br>
          
            <div name='notify'>
          
                 <span  style="color: red;" >--you have No Notifcation--</span>
         
            </div>
            
            <br>

           
        </div>
      

                 
         
      </li>
    </div>
</template>

<script type='text/javascript'>
    export default {
        name:'Notification',
        data(){
            return{
                Notifications:[],
                location:'',
   
            }
           
        }
        ,methods:{
            getNotification() {
         axios.get('/admin/All-Notification')
         .then(({data}) => (this.Notifications = data))
         .catch()
             },
            readNotification(){
        axios.get('/admin/Read-All-Notification')
               .then(res => {    
         this.Notifications =this.Notifications.filter(Product => {
        return '';
         })
           })
            }, 
        }
        ,mounted() {
            var that =this;
           window.Echo.channel('Notification').listen('NotificatonRecieved',event => {
          that.Notifications.unshift(event);
          
          
             
           })
        }
        ,created() {
            this.getNotification(); 
             this.location= window.location.origin
                  
  }
    }
</script>
<style>
#animation{
    cursor: pointer;
    transition: all 1s;
    animation: Notification 1s infinite;

}
    @keyframes Notification {
             0%,
         100% {
    opacity: 0.5;
        }
         50% {
    opacity: 1;
  }
}
.notify{
    text-align: center;
}
#readall{
    margin-top: 5px;
padding: 10px;
padding-left: 30px;
padding-right: 30px;
color:black;

}
.divScroll {
overflow:scroll;
height: 400px;
}




</style>
