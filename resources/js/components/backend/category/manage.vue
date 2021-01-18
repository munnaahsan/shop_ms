<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" v-if="hideForm">
<!--                    @submit.prevent="addCategory"-->
                    <form @submit.prevent="addCategory">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" :class="{'is-invalid': form.errors.has('name')}"
                                                   name="name" placeholder="Enter Category Name"
                                                   type="text" v-model="form.name">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea class="form-control" v-model="form.remarks" name="remarks" id="remarks" cols="30"
                                                      :class="{'is-invalid': form.errors.has('remarks')}" placeholder="Wright Your Remarks"
                                                      style="height: 37px"></textarea>
                                            <has-error :form="form" field="remarks"></has-error>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group w-25" role="group" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">
                                <button class="btn btn-sm btn-primary" title="Save Your Content" type="submit">
                                    <i class="fas fa-save fa-1x"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"
                                        data-toggle="tooltip" @click="hide" data-placement="top" title="Close The Modal Window">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="card-title">Categories</span>
                                    </div>
                                    <div class="col-md-8">
<!--                                        :disabled="!isSelected" @click="removeItems(selected)"-->
                                        <button data-toggle="tooltip" data-placement="bottom" title="Delete"  id="display"
                                                class="text-danger border-0" type="button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
<!--                                data-toggle="modal" data-target="#category-add" -->
                                <span href="javascript:void(0)"
                                   class="btn btn-info float-right btn-sm"
                                   id="add" v-on:click="hideForm = !hideForm" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">
                                    <i class="fas fa-plus-circle"></i> Add
                                </span>
<!--                                <router-link to="/categories" class="btn btn-secondary float-right btn-sm mr-1"-->
<!--                                             style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3); width: 60px">-->
<!--                                    <i class="fas fa-arrow-alt-circle-left"></i>-->
<!--                                </router-link>-->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>
<!--                                  v-model="multiDelete"  :disabled="emptyData()" @click="selectAll"-->
                                    <input  style="cursor: pointer"
                                           type="checkbox" >
                                </th>
                                <th>Sl. No.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Remarks</th>
<!--                                <th>Created At</th>-->
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
<!--                v-for="(category, i) in categories"            @click="visible = !visible"-->
                            <tr v-for="(category, i) in categories">
                                <td>
<!--                        v-model="selected"            :value="category.id"-->
                                    <input  style="cursor: pointer"
                                           type="checkbox" >
                                </td>
<!--                                {{ ++i }}-->
                                <td>{{ ++i }}</td>
<!--                                {{ category.name }}-->
                                <td>{{ category.name }}</td>
                                <td>{{ category.slug }}</td>
<!--                                {{ category.slug }}-->
                                <td>{{ category.remarks }}</td>
<!--                                {{ category.created_at | time}}-->
<!--                                <td></td>-->
                                <td>
                                    <!--      router-link         :to="`/edit-category/${category.slug}`"         ${category.slug}-->
                                    <router-link :to="`/edit-category/${category.slug}`" class="text-cyan" ><i
                                        class="fas fa-edit"></i></router-link>
<!--                                    @click="remove(category.slug)"-->
                                    <span class="text-danger" style="cursor: pointer" ><i
                                        class="fas fa-trash-alt"></i></span>
                                </td>
                            </tr>
<!-- v-bind:style="!isSelected" id="display" v-if="visible && selectAll"-->
<!--                            <tr>-->
<!--                                <td colspan="7">-->
<!--                                    <button :disabled="!isSelected" id="display" @click="removeItems(selected)"-->
<!--                                            class="text-danger border-0" type="button">-->
<!--                                        <i class="fas fa-trash"></i>-->
<!--                                    </button>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            <tr v-if="emptyData()">-->
<!--                                <td colspan="6">-->
<!--                                    <h6 class="text-center text-danger">Data Not Found !!</h6>-->
<!--                                </td>-->
<!--                            </tr>-->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!--        <data-table-->
        <!--            url="http://vue-datatable.test/ajax"-->
        <!--            :per-page="perPage"-->
        <!--            :columns="columns">-->
        <!--        </data-table>-->
<!--        <div class="modal fade" id="category-add">-->
<!--            <div class="modal-dialog">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h4 class="modal-title">Add Category</h4>-->
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                            <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                    <form @submit.prevent="addCategory">-->
<!--                        <div class="modal-body">-->
<!--                            <div class="card-body">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="name">Name</label>-->
<!--                                    <input :class="{'is-invalid': form.errors.has('name')}"-->
<!--                                           class="form-control" id="name"-->
<!--                                           name="name" placeholder="Enter Category Name"-->
<!--                                           type="text" v-model="form.name">-->
<!--                                    <has-error :form="form" field="name"></has-error>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Status</label>-->
<!--                                    <div :class="{'is-invalid': form.errors.has('remarks')}" class="form-control">-->
<!--                                        <div class="row">-->
<!--                                            <div class="custom-control custom-radio" style="padding-left: 36px;">-->
<!--                                                <input class="custom-control-input"-->
<!--                                                       id="active" type="radio" v-model="form.remarks" value="1">-->
<!--                                                <label for="active" class="custom-control-label pr-4"-->
<!--                                                       style="cursor: pointer">Active</label>-->
<!--                                            </div>-->
<!--                                            <div class="custom-control custom-radio">-->
<!--                                                <input class="custom-control-input"-->
<!--                                                       id="inactive" type="radio" v-model="form.remarks" value="0">-->
<!--                                                <label for="inactive" class="custom-control-label"-->
<!--                                                       style="cursor: pointer">Inactive</label>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <has-error :form="form" field="remarks"></has-error>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="modal-footer">-->
<!--                            <div class="btn-group w-25" role="group" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">-->
<!--                                <button class="btn btn-sm btn-primary" data-placement="top" data-toggle="tooltip"-->
<!--                                        title="Save Your Content"-->
<!--                                        type="submit">-->
<!--                                    <i class="fas fa-save fa-1x"></i>-->
<!--                                </button>-->
<!--                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"-->
<!--                                        data-toggle="tooltip" data-placement="top" title="Close The Modal Window">-->
<!--                                    <i class="fas fa-window-close"></i>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--                &lt;!&ndash; /.modal-content &ndash;&gt;-->
<!--            </div>-->
<!--            &lt;!&ndash; /.modal-dialog &ndash;&gt;-->
<!--        </div>-->
        <!-- /.modal -->
    </div>
</template>

<script>
    export default {
        name: "manage",
        data(){
        return{
            form: new Form({
                name: null,
                slug: null,
                remarks: null,
            }),
            hideForm: false,
          }
        },
        computed: {
            categories() {
                return this.$store.getters.categories
            }
        },
        mounted() {
            // By Mounted Hit A Method of actions option of js file
            // Whenever Load The Component Data will get from database
            // By The actions option of js file
            // document.querySelector('#display').style.display = 'none';
            this.$store.dispatch("getCategories");
            this.editCategory();
        },
        methods: {
            addCategory: function () {
                // console.log('test');
                let category = this;
                this.form.post('/add-category')
                    .then((response) => {
                        // console.log(data)
                        // Toast.fire({
                        //     icon: 'success',
                        //     title: 'Category Created successfully'
                        // })
                        toastr.success("Category Created successfully", {
                            "closeButton": true,
                            "timeOut": "5000",
                            "progressBar": true
                        })
                        // $('#category-add').modal('hide');
                        this.hideForm = false
                        this.$store.dispatch("getCategories")
                        // category.$router.push("/categories");
                        category.form.name = null;
                        category.form.remarks = null;
                    })
            },
            editCategory: function(){
                const this_ = this;
                axios.get("/show-category/"+this.$route.params.slug).then((response)=>{
                    this_.form.fill(response.data[1])
                    // console.log(response.data[1])
                }).catch(()=>{

                })
            },
            hide(){
                this.hideForm = false;
            }
        }
    }
</script>

<style scoped>

</style>
