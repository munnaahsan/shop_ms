<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" v-if="hideForm">
                    <!--                    @submit.prevent="addCategory"-->
                    <form>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s_name">Name</label>
                                            <input class="form-control" id="s_name"
                                                   :class="{'is-invalid': form.errors.has('s_name')}"
                                                   name="s_name" placeholder="Enter Supliers Name" type="text"
                                                   v-model="form.s_name">
                                            <has-error :form="form" field="s_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s_contact">Contact</label>
                                            <input type="tel" name="s_contact" id="s_contact" required
                                                   maxlength="11" pattern="[0-9]{11}" placeholder="Enter Contact Number" class="form-control"
                                                   :class="{'is-invalid': form.errors.has('s_contact')}"
                                                   v-model="form.s_contact">
                                            <has-error :form="form" field="s_contact"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s_email">E-Mail</label>
                                            <input type="tel" name="s_email" id="s_email" required
                                                   maxlength="11" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Enter Your E-Mail" class="form-control"
                                                   :class="{'is-invalid': form.errors.has('s_email')}"
                                                   v-model="form.s_email">
                                            <has-error :form="form" field="s_contact"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s_address">Address</label>
                                            <textarea class="form-control" v-model="form.s_address" name="s_address" id="s_address" cols="30" :class="{'is-invalid': form.errors.has('s_address')}" placeholder="Wright Your Remarks" style="height: 37px"></textarea>
                                            <has-error :form="form" field="s_address"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s_remarks">Remarks</label>
                                            <textarea class="form-control" v-model="form.s_remarks" name="s_remarks" id="s_remarks" cols="30" :class="{'is-invalid': form.errors.has('s_remarks')}" placeholder="Wright Your Remarks" style="height: 37px"></textarea>
                                            <has-error :form="form" field="s_remarks"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group float-right w-25" role="group" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);margin-top: 36px;">
                                            <button class="btn btn-primary" title="Save Your Content" type="submit">
                                                <i class="fas fa-save fa-1x"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" @click="hide" data-placement="top" title="Close The Modal Window">
                                                <i class="fas fa-window-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                                        <span class="card-title text-uppercase">suppliers</span>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
<!--                                            @click="removeItems(selected)"-->
                                            <button data-toggle="tooltip" data-placement="bottom" title="Delete"
                                                    :disabled="!isSelected"
                                                    id="display" class="btn btn-sm btn-outline-danger" type="button">
                                                <i class="fas fa-trash"></i>
                                            </button>&nbsp;&nbsp;
                                            <button style="cursor: pointer;background-image: linear-gradient(#7a9cac, #6fb6d4)" class="btn btn-sm border-0"
                                                    @click="generatePDF" id="pdf" data-toggle="tooltip" data-placement="bottom" title="Generate PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--                                data-toggle="modal" data-target="#category-add" -->
                                <span href="javascript:void(0)" class="btn btn-info float-right btn-sm" id="add" v-on:click="hideForm = !hideForm" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">
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
                                        <input :disabled="emptyData()" @click="selectAll" style="cursor: pointer"
                                               type="checkbox" v-model="multiDelete">
                                    </th>
                                    <th>Sl. No.</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Slug</th>
                                    <th>E-Mail</th>
                                    <th>Address</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(supplier, i) in suppliers">
                                    <td>
                                        <input :value="supplier.id" style="cursor: pointer"
                                           type="checkbox" v-model="selected">
                                    </td>
                                    <td>{{ ++i }}</td>
                                    <td>{{ supplier.s_name }}</td>
                                    <td>{{ supplier.s_contact }}</td>
                                    <td>{{ supplier.slug }}</td>
                                    <td>{{ supplier.s_email }}</td>
                                    <td>{{ supplier.s_address }}</td>
                                    <td>{{ supplier.s_remarks }}</td>
                                    <td>
<!--                                        :to="`/edit-category/${category.slug}`" @click="remove(category.slug)"-->
                                        <router-link class="text-cyan" to=""><i class="fas fa-edit"></i></router-link>
                                        <span class="text-danger" style="cursor: pointer"><i class="fas fa-trash-alt"></i></span>
                                    </td>
                                </tr>
                                <tr v-if="emptyData()">
                                    <td colspan="6">
                                        <h6 class="text-center text-danger">Data Not Found !!</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "manage",
    data() {
        return {
            form: new Form({
                s_name: null,
                s_contact: null,
                slug: null,
                s_email: null,
                s_address: null,
                s_remarks: null,
            }),
            hideForm: false,
            selected: [],
            multiDelete: false,
            isSelected: false,
        }
    },
    computed: {
        suppliers() {
            return this.$store.getters.suppliers
        }
    },
    mounted() {
        // By Mounted Hit A Method of actions option of js file
        // Whenever Load The Component Data will get from database
        // By The actions option of js file
        document.querySelector('#display').style.display = 'none';
        this.$store.dispatch("getSuppliers");
        $('#pdf').tooltip()
        // this.editCategory();
    },
    watch: {
        // selected: function (selected) {
        //     // this.visible = true;
        //     if (selected.length > 0)
        //     {
        //         $(function () {
        //             $('[data-toggle="tooltip"]').tooltip()
        //         })
        //         document.querySelector('#display').style.display = 'block';
        //     }else
        //     {
        //         $(function () {
        //             $('[data-toggle="tooltip"]').tooltip('hide')
        //         })
        //         document.querySelector('#display').style.display = 'none';
        //     }
        //     this.isSelected = (selected.length > 0);
        //     this.multiDelete = (selected.length === this.categories.length);
        // }
    },
    methods: {
        // addCategory: function() {
        //     // console.log('test');
        //     let category = this;
        //     this.form.post('/add-category')
        //         .then((response) => {
        //             // console.log(data)
        //             // Toast.fire({
        //             //     icon: 'success',
        //             //     title: 'Category Created successfully'
        //             // })
        //             toastr.success("Category Created successfully")
        //             // $('#category-add').modal('hide');
        //             this.hideForm = false
        //             this.$store.dispatch("getCategories")
        //             // category.$router.push("/categories");
        //             category.form.name = null;
        //             category.form.remarks = null;
        //         })
        // },
        // editCategory: function() {
        //     const this_ = this;
        //     axios.get("/show-category/" + this.$route.params.slug).then((response) => {
        //         this_.form.fill(response.data[1])
        //         // console.log(response.data[1])
        //     }).catch(() => {

        //     })
        // },
        // remove: function(slug) {
        //     const swalWithBootstrapButtons = Swal.mixin({
        //         customClass: {
        //             confirmButton: 'btn btn-success',
        //             cancelButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //     })
        //
        //     swalWithBootstrapButtons.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, delete it!',
        //         cancelButtonText: 'No, cancel!',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             axios.get("remove-category/" + slug).then((response) => {
        //                 this.$store.dispatch("getCategories"),
        //                     // toastr.success('Category Deleted Successfully !!')
        //                     swalWithBootstrapButtons.fire(
        //                         'Deleted!',
        //                         'Your file has been deleted.',
        //                         'success'
        //                     )
        //             }).catch((error) => {
        //
        //             })
        //         } else if (
        //             /* Read more about handling dismissals below */
        //             result.dismiss === Swal.DismissReason.cancel
        //         ) {
        //             swalWithBootstrapButtons.fire(
        //                 'Cancelled',
        //                 'Your imaginary file is safe :)',
        //                 'error'
        //             )
        //         }
        //     })
        // },
        hide() {
            this.hideForm = false;
        },
        emptyData() {
            return (this.suppliers.length < 1)
        },
        selectAll: function (event) {
            if (event.target.checked === false) {
                this.selected = []
                // document.querySelector('#display').style.display = 'none';
            } else {
                // document.querySelector('#display').style.display = 'block';
                this.categories.forEach((category) => {
                    if (this.selected.indexOf(category.id) === -1)
                    {
                        this.selected.push(category.id)
                    }
                })
            }
        },
        // removeItems: function (selected) {
        //     // console.log(selected)
        //     axios.post("/categories/remove-items",{data: selected}).then((response) => {
        //         // console.log(response.data)
        //         this.selected = [],
        //             this.multiDelete = false,
        //             this.isSelected = false,
        //             this.$store.dispatch("getCategories")
        //         toastr.success(response.data.total + ' Category has been deleted successfully !!')
        //     }).catch((error) => {
        //
        //     })
        // },
        generatePDF: function()
        {
            //initialize a new instance of jsPDF
            pdfDoc.autoTable({ html: '#example1' })
            // pdfDoc.html("get-categories",15,15)
            pdfDoc.save("pdf.pdf")
            $('#pdf').tooltip('hide')
        }
    }
}

</script>
<style scoped>
    #pdf:hover{
        color: #f9d6d5;
    }
    #s_contact:valid {
    color: green;
}

    #s_contact:invalid {
        color: red;
    }

    #s_email:valid {
        color: green;
    }

    #s_email:invalid {
        color: red;
    }
</style>
