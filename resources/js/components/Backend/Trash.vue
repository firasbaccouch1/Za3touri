<template>
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">All Trashs</h1>
          <br>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Trashed Data</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"><label>Show 
                  <select name="dataTable_length" @change="onchange($event)" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                    <option value="all">All</option>
                    <option value="Categories">Categories</option>
                    <option value="Products">Products</option>
                    <option  value="Sliders">Sliders</option>
                    </select> </label>
                    </div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="text" v-model="searchItem" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div><div class="row"><div class="col-sm-12">
                      <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                  <thead>
                    <tr role="row">
                          <th>Type</th>
                         <th>photo</th>
                         <th>Name</th>
                         <th>Category</th>
                         <th>Deleted by</th>
                         <th>Deleted AT</th>
                         <th>Action</th>
                    </tr>
                  

                  </thead>
                  <tbody> 
                  <tr role="row" class="odd" v-for="Trashed in filtersearch" :key='Trashed.index'>
                      <td class="sorting_1"><span class="badge badge-pill badge-info">{{ Trashed.type }}</span></td>
                      <td v-if="Trashed.type == 'category'"><i :class="Trashed.photo+' fa-2x'"></i></td>
                      <td v-else><img :src="location+'/'+Trashed.photo" class="width" alt=""></td>
                      <td>{{ Trashed.name }}</td>
                      <td v-if="Trashed.category">{{ Trashed.category.name_en }}</td>
                      <td v-else></td>
                      <td><span class="badge badge-pill badge-warning">{{  Trashed.deleted_by }}</span></td>
                      <td>{{  Trashed.deleted_at| formatDate }}</td>
                      <td class='action'>
                          <a @click.prevent="deleteTrash(Trashed.id,Trashed.type)" title="perment_delete" class="btn btn-danger"><i class="fas fa-trash fa-lg"></i></a>
                          <a @click.prevent="restoreTrash(Trashed.id,Trashed.type)" title="Restore" class="btn btn-warning"><i class="fas fa-reply-all fa-lg"></i></a>
                          <a v-bind:href="location+'/admin/Trashed-edit/'+Trashed.id+'/'+Trashed.type" title="edit" class="btn btn-info"><i class="fas fas fa-edit fa-lg"></i></a>
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
</template>
<script>
   export default {
     name:'Trash',
        created(){
          this.AllTrashed();
         this.location= window.location.origin
        },
   data(){
            return{
              Trashed_data:[],
              searchItem:'',
              location:'',
              

   
            }
           
        },computed:{
        filtersearch(){
          return this.Trashed_data.filter(Trash => {
            return Trash.name.match(this.searchItem);
          })
          
        }
      },
      methods:{
          AllTrashed() {
                  axios.get('/admin/allTrashed-Data')
                        .then(res => {
                           this.Trashed_data= res.data.data;
                        })
                        .catch(error=>{}) 
                           },
                      onchange(event){
                            if (event.target.value == 'all') {
                             this.AllTrashed()
                            }
                            if (event.target.value == 'Categories') {
                              axios.get('/admin/Trashed-categories')
                        .then(res => {
                           this.Trashed_data= res.data.data;
                        })
                        .catch(error=>{}) 
                        }
                            if (event.target.value == 'Products') {
                           axios.get('/admin/Trashed-products')
                        .then(res => {
                           this.Trashed_data= res.data.data;
                        })
                        .catch(error=>{}) 
                        
                            }if (event.target.value == 'Sliders') {
                              axios.get('/admin/Trashed-sliders')
                        .then(res => {
                           this.Trashed_data= res.data.data;
                        })
                        .catch(error=>{}) 
                            }

                          }
                      ,deleteTrash(id,type){
                              Swal.fire({
                              title: "Are you sure You want to Delete this "+type+"?!!",
                              text: 'it we be deleing the related rows of '+type+' as well',
                              icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#e74a3b',
                      cancelButtonColor:  '#3085d6',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        axios.delete('/admin/Trashed-deleted/'+id+'/'+type)
                        .then((res)=> {
                          if (res.data.status == 401) {
                               Swal.fire(
                          'Warning',
                          "You don't have Permission",
                          'warning'
                        )
                          }else{
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        )
                        window.location.reload()
                          }
                        }).catch((error)=> {
                          
                         Swal.fire(
                          'error',
                          'Somthing went wrong please try again later',
                          'error'
                        )
                        })
                      }
                    })

                            }, 
                                restoreTrash(id,type){
                              Swal.fire({
                              title: 'Are you sure',
                              text: "You want to Restore this "+type,
                              icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#1cc88a',
                      cancelButtonColor: '#3085d6',
                      confirmButtonText: 'Yes, Restore it!'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        axios.get('/admin/Trashed-restore/'+id+'/'+type)
                        .then((res)=> {
                          if (res.data.status == 401) {
                            console.log('yes')
                               Swal.fire(
                          'Warning',
                          "You don't have Permission",
                          'warning'
                        )
                          }
                          else{
                         Swal.fire(
                          'Restored',
                          'Your file has been Restored Successfully',
                          'success'
                        )
                        window.location.reload()
                         }  
                      if (res.data.status == 303) {
                        Swal.fire(
                          'Warning',
                          res.data.data,
                          'warning'
                        )
                          }    
                        })
                        .catch((error)=> {
                         Swal.fire(
                          'error',
                          'Somthing went wrong please try again later',
                          'error'
                        )
                        })
                      }
                    })

                            }

                      


        },
   }
</script>
<style>
.width{
  max-width: 70px;
  max-height: 50px;

}

td{
  text-align: center;
justify-content: center;

}
i{
  color: rgba(71, 71, 71, 0.808);
}





</style>
