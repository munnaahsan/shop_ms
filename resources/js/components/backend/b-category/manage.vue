<template>
    <div>
        <b-container>
            <b-row>
                <b-col md="8" offset="2">
                    <b-card v-if="show">
                        <b-form @submit="onSubmit" @reset="onReset">
                            <b-form-group
                                id="input-group-1"
                                label="Email address:"
                                label-for="input-1"
                                description="We'll never share your email with anyone else.">
                                <b-form-input
                                    id="input-1"
                                    v-model="form.email"
                                    type="email"
                                    placeholder="Enter email"
                                    required
                                ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
                                <b-form-input
                                    id="input-2"
                                    v-model="form.name"
                                    placeholder="Enter name"
                                    required
                                ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-3" label="Food:" label-for="input-3">
                                <b-form-select
                                    id="input-3"
                                    v-model="form.food"
                                    :options="foods"
                                    required
                                ></b-form-select>
                            </b-form-group>

                            <b-row>
                                <b-col md="12" class="d-flex justify-content-end">
                                    <b-button-group>
                                        <b-button type="submit" variant="primary">Submit</b-button>
                                        <b-button type="reset" v-on:click="show = !show" variant="danger">Reset</b-button>
                                    </b-button-group>
                                </b-col>
                            </b-row>
                        </b-form>
                    </b-card>
                </b-col>
            </b-row>

<!--            <b-card>-->
<!--                <b-row>-->
<!--                    <b-col striped :sm="pageSize" :md="pageSize" class="my-1">-->
<!--                        <b-form-group-->
<!--                            label="Per page"-->
<!--                            label-cols-sm="6"-->
<!--                            label-cols-md="6"-->
<!--                            label-cols-lg="6"-->
<!--                            label-align-sm="left"-->
<!--                            label-size="sm"-->
<!--                            label-for="perPageSelect"-->
<!--                            class="mb-0"-->
<!--                        >-->
<!--                            <b-form-select v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"></b-form-select>-->
<!--                        </b-form-group>-->
<!--                    </b-col>-->
<!--                    <b-col>-->
<!--                        <span href="javascript:void(0)" class="btn btn-info float-right mb-2 btn-sm" id="add"-->
<!--                              v-on:click="show = !show" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">-->
<!--                                    <i class="fas fa-plus-circle"></i> Add-->
<!--                        </span>-->
<!--                    </b-col>-->
<!--                    <b-col :sm="searchSize" :md="searchSize" class="my-1 ml-auto">-->
<!--                        <b-input-group size="sm">-->
<!--                            <b-form-input-->
<!--                                v-model="rawInput"-->
<!--                                type="search"-->
<!--                                label-align-sm="right"-->
<!--                                id="filterInput"-->
<!--                                placeholder="Type to Search"-->
<!--                                :debounce="200"-->
<!--                            ></b-form-input>-->
<!--                            <b-input-group-append>-->
<!--                                <b-button class="data-table-filter" :disabled="!filter" @click="clear()">Clear</b-button>-->
<!--                            </b-input-group-append>-->
<!--                        </b-input-group>-->
<!--                    </b-col>-->
<!--                </b-row>-->
<!--                <b-row>-->
<!--                    <b-col>-->
<!--                        <b-table striped hover-->
<!--                                 :filter="filter"-->
<!--                                 :fields="fields"-->
<!--                                 :items="categories"-->
<!--                                 :per-page="perPage"-->
<!--                                 :current-page="currentPage">-->
<!--                            <template v-slot:cell(index)="row" v-if="currentPage <= 1">-->
<!--                                {{ (row.index + 1) }}-->
<!--                            </template>-->
<!--                            <template v-slot:cell(index)="row" v-else>-->
<!--                                {{ (perPage * (currentPage-1)) + (row.index + 1) }}-->
<!--                            </template>-->
<!--                            <template v-slot:actions="{ rows }">-->
<!--                                <b-link ml="4" class="text-primary" :to="`/edit-category/${rows.slug}`"><i class="fa fa-edit cursor-pointer"></i></b-link>-->
<!--                                <b-link class="text-danger" v-b-modal.family-remove @click="deletedItem = rows.item"><i class="fa fa-trash cursor-pointer"></i></b-link>-->
<!--                            </template>-->
<!--                            <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage"></b-pagination>-->
<!--                        </b-table>-->
<!--                    </b-col>-->
<!--                </b-row>-->
<!--                <b-row>-->
<!--                    <b-col sm="12" md="12" class="mt-0">-->
<!--                        <b-pagination-->
<!--                            v-model="currentPage"-->
<!--                            :total-rows="rows"-->
<!--                            :per-page="perPage"-->
<!--                            align="right"-->
<!--                            size="sm"-->
<!--                            class="my-0"-->
<!--                        ></b-pagination>-->
<!--                    </b-col>-->
<!--                </b-row>-->
<!--            </b-card>-->
            <b-card>
                <b-row>
                    <b-col>
                        <span href="javascript:void(0)" class="btn btn-info float-right mb-2 btn-sm" id="add"
                              v-on:click="show = !show" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">
                                    <i class="fas fa-plus-circle"></i> Add
                        </span>
                    </b-col>
                </b-row>
                <b-card-body class="border">
                    <Datatable v-bind:fields="fields" v-bind:items="categories" :totalList="totalList" :perPage="perPage"
                               :primaryKeyColumnName="'id'">
                        <template v-slot:actions="{ rows }">
                            <b-link ml="4" class="text-primary" :to="`/edit-category/${categories[0].slug}`"><i class="fas fa-edit cursor-pointer"></i></b-link>
                            <b-link class="text-danger" v-b-modal="'family-remove'" @click="deletedItem = rows.item"><i class="fas fa-trash cursor-pointer"></i></b-link>
                        </template>
                    </Datatable>
                    <b-modal :id="'family-remove'" :centered="true" title="Please Confirm" size="sm"
                             buttonSize="sm" okTitle="YES" cancelTitle="NO" footerClass="p-2"
                             :hideHeaderClose="false"
                             @ok="deleteRow()" @hidden="deletedItem = null">
                        <div>Are you sure you want to delete?</div>
                    </b-modal>
                </b-card-body>
            </b-card>
        </b-container>
    </div>
</template>

<script>
    import Datatable from '../../common/datatable';
    export default {
        components: { Datatable },
        name: "manage",
        data() {
            return {
                form: new Form({
                    name: null,
                    slug: null,
                    remarks: null,
                }),
                show: false,
                rawInput: null,
                items: [],
                totalList: 1,
                totalRows: 1,
                perPage: 2,
                currentPage:1,
                pageOptions: [5, 10, 15],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                deletedItem: null,
                filterOn: [],
                pageSize: (this.pageColSize != undefined) ? this.pageColSize : '2',
                searchSize: (this.searchColSize != undefined) ? this.searchColSize : '3',
                fields: [
                    { key: 'index', label: 'Sl'},
                    { key: 'name', label: 'Name',   name: 'name', sortable: true },
                    { key: 'slug', label: 'Slug',  name: 'slug', sortable: true },
                    { key: 'remarks', label: 'Remarks',  name: 'remarks', sortable: true }, 'action']
            }
        },
        computed: {
            categories() {
                return this.$store.getters.categories
            },
            rows(){
                return this.categories.length
            }
        },
        mounted() {
            // By Mounted Hit A Method of actions option of js file
            // Whenever Load The Component Data will get from database
            // By The actions option of js file
            // document.querySelector('#display').style.display = 'none';
            this.$store.dispatch("getCategories");
            $('#pdf').tooltip()
            // this.editCategory();
        },
        watch: {
            selected: function (selected) {
                // this.visible = true;
                if (selected.length > 0)
                {
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                    // document.querySelector('#display').style.display = 'block';
                }else
                {
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip('hide')
                    })
                    // document.querySelector('#display').style.display = 'none';
                }
                this.isSelected = (selected.length > 0);
                this.multiDelete = (selected.length === this.categories.length);
            }
        },
        methods: {
            clear() {
                this.filter = ''
                this.rawInput = '';
            },
            addCategory: function() {
                // console.log('test');
                let category = this;
                this.form.post('/add-category')
                    .then((response) => {
                        // console.log(data)
                        // Toast.fire({
                        //     icon: 'success',
                        //     title: 'Category Created successfully'
                        // })
                        toastr.success("Category Created successfully")
                        // $('#category-add').modal('hide');
                        this.hideForm = false
                        this.$store.dispatch("getCategories")
                        // category.$router.push("/categories");
                        category.form.name = null;
                        category.form.remarks = null;
                    })
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalList = filteredItems.length;
                this.currentPage = 1
            },
            // editCategory: function() {
            //     const this_ = this;
            //     axios.get("/show-category/" + this.$route.params.slug).then((response) => {
            //         this_.form.fill(response.data[1])
            //         // console.log(response.data[1])
            //     }).catch(() => {

            //     })
            // },
            remove: function(slug) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get("remove-category/" + slug).then((response) => {
                            this.$store.dispatch("getCategories"),
                                // toastr.success('Category Deleted Successfully !!')
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                        }).catch((error) => {

                        })
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                })
            },
            hide() {
                this.hideForm = false;
            },
            emptyData() {
                return (this.categories.length < 1)
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
            removeItems: function (selected) {
                // console.log(selected)
                axios.post("/categories/remove-items",{data: selected}).then((response) => {
                    // console.log(response.data)
                    this.selected = [],
                        this.multiDelete = false,
                        this.isSelected = false,
                        this.$store.dispatch("getCategories")
                    toastr.success(response.data.total + ' Category has been deleted successfully !!')
                }).catch((error) => {

                })
            },
            generatePDF: function()
            {
                //initialize a new instance of jsPDF
                pdfDoc.autoTable({ html: '#example1' })
                // pdfDoc.html("get-categories",15,15)
                pdfDoc.save("pdf.pdf")
                $('#pdf').tooltip('hide')
            },
            deleteRow() {
                if (this.deletedItem !== undefined && this.deletedItem) {
                    ApiRepository.callApi(ApiRepository.DELETE_COMMAND, `/pmis/employee/families/${this.deletedItem.emp_family_id}`).then(res => {
                        if (res.data.o_status_code == 1) {
                            this.$notify({group: 'pmis', text: res.data.o_status_message, type: 'success'});
                        } else {
                            this.$notify({group: 'pmis', text: res.data.o_status_message, type: 'error'});
                        }

                        this.deletedItem = null;
                        this.loadData();
                        this.onReset();
                    }).catch(err => {
                        this.deletedItem = null;
                        console.log(err);
                    });
                }
            }
        }
    }

</script>
<style scoped>

</style>
